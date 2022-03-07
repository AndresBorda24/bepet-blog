@props(['link' => auth()->check() ? Auth::user()->avatar->link : ''])

<img src="{{ Storage::url($link) }}" {{ $attributes }} alt="userAvatar">