<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination; 

    /**
     * Properties linked to livewire, each property corresponds to a table title
     */
    public $props;

    /**
     * CRUD routes
     */
    public $route;

    /**
     * Fields present on the query
     */
    public $fields;

    /**
     * Headers of the (data)table
     */
    public $tableFields;

    /**
     * Optional 'default' methods for queries
     */
    public $methods;

    /**
     * Namespace of eloquent model
     */
    public $table;

    /**
     * Represent wheter the (data)table should display filters
     */
    public $filters;

    public $orderBy;

    public $direction = 'asc';

    protected $query;

    public function mount($table, $route, $fields, $methods=[], $filters)
    {
        $this->table   = $table;
        $this->route   = $route;
        $this->fields  = $fields;
        $this->methods = $methods;
        $this->filters = $filters;
        $this->orderBy = $fields[array_keys($fields)[0]][0];

        // dd($this->filters);
        foreach ($fields as $title => $field) {
            if ($field[1]) {
                $this->props[$field[0]] = "";
                $this->tableFields[] = $title;
            }
        }
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function buildQuery()
    {
        $this->query = $this->initializeQuery();;

        foreach ($this->methods as $method) {
            $this->query->$method();
        }

        $select = [];
        
        foreach ($this->fields as $field) {
            if ($field[1]) {
                $this->query->where($field[0], 'LIKE', '%'. $this->props[$field[0]] .'%');
            }
            $select[] = $field[0];
        }

        $this->query->select($select)->orderBy($this->orderBy, $this->direction);
    }

    public function order($field)
    {
        if ($this->orderBy == $field){
            if ($this->direction == 'asc'){
                $this->direction = 'desc';
            } else {
                $this->direction = 'asc';
            }
        } else {
            $this->orderBy = $field;
        }
    }

    public function resetFilters()
    {
        foreach ($this->props as $key => $value) {
            $this->props[$key] = "";
        }

        $this->resetPage();
    }

    public function initializeQuery()
    {
        $model = new $this->table;
        return $model->query();
    }

    public function render()
    {
        $this->buildQuery();

        return view('livewire.table', [
            'records' => $this->query->paginate(7),
        ]);
    }
}
