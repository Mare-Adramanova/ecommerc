<nav class="navbar navbar-expand-sm bg-primary text-white d-flex justify-content-between">
    <a class="app-header__logo text-white" href="#">{{ config('app.name') }}</a>

    <div>
        <form action="{{ route('search.index') }}" method="POST">
          @csrf
          <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Search this blog">
            <div class="input-group-append">
              <button class="btn btn-secondary" type="submit" value="Search this page">
                <i class="fa fa-search mt-1"></i>
              </button>
              
            </div>
          </div>
  
        </form>
  
      </div>

</nav>