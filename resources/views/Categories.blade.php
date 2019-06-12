@extends('layout')

@section('content')
    <div class="card categories-list" style="width: 18rem;">
        <ul class="list-group">
            @foreach ($categories as $category)
                @if ($category->parent_id === NULL)
                    @php display_children($categories, $category); @endphp
                @endif
            @endforeach
        </ul>
    </div>

    @php
        function display_children($list, $curr_item) {
            echo '<li class="list-group-item">';
            
            echo '<a class="nav-link " href="/category/'.strtolower($curr_item->name).'">'.$curr_item->name.'</a>';
            $children_count = 0;
            foreach ($list as $item) {
                if ($item->parent_id === $curr_item->id) {
                    if ($children_count === 0) {
                        echo '<ul class="list-group-flush">';
                    } 
                    $children_count++;
                    display_children($list, $item);
                }
            }
            if ($children_count > 0) {
                echo '</ul>';
            } 
            
            echo '</li>';
        }
    @endphp
@endsection