<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
  <a class="navbar-brand" href="/">The Big Library</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/home') echo 'active' ?>">
        <a class="nav-link" href="/">Media</a>
      </li>
      <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/publishers') echo 'active' ?>">
        <a class="nav-link" href="/publishers">Publishers</a>
      </li>
      <li class="nav-item <?php if ($_SERVER['REQUEST_URI'] == '/control') echo 'active' ?>">
        <a class="nav-link" href="/control">Control</a>
      </li>
    </ul>
  </div>
</nav>