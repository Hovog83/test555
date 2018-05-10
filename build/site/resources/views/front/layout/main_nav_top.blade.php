<nav id="nav-wrapper" class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
  <ul class="nav custom-list pull-right">
    <li class="has-submenu">
      <a href="/">
        <span class="caption">Home</span>
      </a>
    </li>
    @foreach(Layout::getMenuTop() as $value)
    <li class="has-submenu">
       <a href="/pages/{{$value->getpages->slug}}" >{{trans('interface.'.$value->getpages->titleCode)}}</a>
    </li>
  @endforeach
  </ul>
</nav>