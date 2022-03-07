<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListingTable extends Component
{

    /**
     * Collection of data
     */
    public $list;

    /**
     * Titles that are going to be displayed on the table
     */
    public $tableTitles;

    /**
     * Keys of the data Collection
    */    
    public $dataKeys;

    /**
     * Action routes:
     * -Destroy
     * -Edit
     */
    public $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($list, $fields, $route)
    {
        $this->list = $list;
        $this->tableTitles = array_keys($fields);
        $this->dataKeys = $fields;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.listing-table');
    }
}
