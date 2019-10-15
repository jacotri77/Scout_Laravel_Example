

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">{{config('app.name', 'Scout PHP Example')}}</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/services">Services</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/posts">Blog</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-link"><a class="nav-link" href="/posts/create">Create Post</a></li>
        </ul>
      </div>
    </nav>