<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Items</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark justify-content-between">
            <div class="navbar-nav">
                <ul class="navbar-nav bd-navbar-nav flex-row">
                    <li class="nav-item">
                        <a class="nav-link " href="/">Categories</a>
                    </li>
                </ul>
            </div>
             <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>
        
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
                
                echo '<a class="nav-link " href="/'.strtolower($curr_item->name).'">'.$curr_item->name.'</a>';
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
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
