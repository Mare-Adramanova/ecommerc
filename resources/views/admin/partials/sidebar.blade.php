<style type="text/css">
    ul a:hover{
        text-decoration: none;
    }
</style>
<div class="bg-dark text-white" style="width: 259px; height:900px">
    <div class="menu" style="font-size:20px">
        <ul class="ml-3">
            <a href="/admin">
                <li class="fa fa-tachometer mt-5 ml-5"></li>
                <br>
                <span class="ml-1">Dashboard</span>
            </a>
            <br>
            <a href="{{ route('admin.orders.index') }}">
                <li class="fa fa-cart-plus mt-3"></li>
                <span>Orders</span>
            </a>
            <br>
            <a href="{{ route('admin.products.index') }}">
                <li class="fa fa-shopping-bag mt-3"></li>  
                <span>Product</span>
            </a>
            <br>
            <a href="{{ route('admin.productVariations.index') }}">
                <li class="fa fa-shopping-bag mt-3"></li>
                <span>Product Variations</span>
            </a>
           
            <br>
            <a href="{{ route('admin.categories.index') }}">
                <li class="fa fa-list-alt mt-3"></li>
                <span>Categories</span>
            </a>
            <br>
            <a href="{{ route('admin.coupons.index') }}">
                <li class="fa fa-money mt-3"></li>
                <span>Coupons</span>
            </a>
            <br>
            <a href="{{ route('admin.users.index') }}">
                <li class="fa fa-user mt-3"></li>
                <span>User</span>
            </a>
            <br>
            <a href="{{ route('admin.colors.index') }}">
                <li class="fa fa-paint-brush mt-3"></li>
                <span>Color</span>
            </a>
            <br>
            <a href="{{ route('admin.sizes.index') }}">
                <li class="fa fa-sort-numeric-asc mt-3"></li>
                <span>Size</span>
            </a>
        </ul>

    </div>

</div>
