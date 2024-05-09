<nav class="navbar navbar-expand-lg navbar-navbar-light" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Route::currentRouteName() === 'map' ? 'active' : '' }}" aria-current="page" href="{{ route('map') }}">Map</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::currentRouteName() === 'import' ? 'active' : '' }}" href="{{ route('import') }}">Import</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::currentRouteName() === 'update_markers' ? 'active' : '' }}" href="{{ route('update_markers') }}">Update Markers</a>
        </li>
      </ul>
    </div>
  </div>
</nav>