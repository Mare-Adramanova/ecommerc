<div id="sidebar-nav">
    <h5 class="mr-2 mt-3 text-danger">All Categories</h5>

    <ul class="nav flex-column">
        @foreach ($categories as $category)
            <li class="nav-item border-bottom" style="font-size: 15px" >
                <a class="nav-link" href="{{ route('products.index', ['category'=>$category->type]) }}">{{$category->type}}</a>
            </li>
        @endforeach
    </ul>  

    <h5 class="mr-2 text-danger mt-2">Sort by ratings</h5>

    <ul class="nav flex-column">
        @foreach ($averages as $average)
            <li class="nav-item border-bottom" style="font-size: 15px" >
                <a class="nav-link" href="{{ route('products.index', ['average'=>$average->value]) }}">{{$average->value}} stars</a>
            </li>
        @endforeach
    </ul>
    <h5 class="mr-2 text-danger mt-2">Filtered by price</h5>
    <ul class="nav flex-column">
        <li class="nav-item border-bottom" style="font-size: 15px">
            <a class="nav-link" href="{{ route('products.index', ['category'=>request()->category, 'sort'=>'low_high']) }}">Low to High</a>
        </li>
        <li class="nav-item border-bottom" style="font-size: 15px">
            <a class="nav-link" href="{{ route('products.index', ['category'=>request()->category, 'sort'=>'high_low']) }}">High to Low</a>
        </li>
    </ul>
</div>

