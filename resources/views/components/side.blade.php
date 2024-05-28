<div class="d-flex sidebar-sticky vh-100 flex-column flex-shrink-0 p-3 text-white bg-dark " style="width: 280px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
      <span class="fs-4">Sidebar</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="{{ (request()->is('/')) ? 'active' : '' }}">
            <a class="nav-link text-white" href="{{route('home')}}">
              <i class="bi bi-house-door-fill"></i>
              <span class="span"> Dashboard</span>
            </a>
        </li>
        <li class="{{ (request()->is('alternatif')) ? 'active' : '' }}">
            <a class="nav-link text-white" href="{{route('alternatif.index')}}">
              <i class="bi bi-laptop-fill"></i> 
              <span class="span">Alternatif</span>
            </a>
        </li>
        <li class="{{ (request()->is('kriteria')) ? 'active' : '' }}">
            <a class="nav-link text-white" href="{{route('kriteria.index')}}">
              <i class="bi bi-card-checklist"></i>
              <span class="span">Kriteria</span>
            </a>
        </li>
        <li class="{{ (request()->is('penilaian')) ? 'active' : '' }}">
            <a class="nav-link text-white" href="{{route('penilaian.index')}}">
              <i class="bi bi-bar-chart-line-fill"></i>
              <span class="span">Penilaian</span>
            </a>
        </li>
        <li class="{{ (request()->is('ranking')) ? 'active' : '' }}">
            <a class="nav-link text-white" href="{{route('ranking.index')}}">
              <i class="bi bi-clipboard-data-fill"></i>
              <span class="span">Ranking</span>
            </a>
        </li>
    </ul>
    <hr>
    <div class="px-2">
      <a href="/session/logout" class="nav-link text-white"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </div>
  </div>
