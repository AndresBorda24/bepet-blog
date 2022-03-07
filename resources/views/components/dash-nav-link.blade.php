@props([
    'route', 
    'routeIs' => isset($routeIs) ? $routeIs : $route
    ])

<a href="{{ route($route) }}" 
    class="inline-block text-xs p-3 border-b-2 border-transparent {{ request()->routeIs($routeIs) ? 'bg-slate-900 border-sky-500 text-sky-500 hover:border-sky-600 hover:text-sky-600' : 'border-transparent hover:border-gray-400 hover:text-gray-400' }}">
    
    {{$slot}}
    
</a>