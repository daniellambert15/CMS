@if (count($page->children) > 0)
<li class="dropdown">
  <a href="/{{ $page->url }}.html" class="dropdown-toggle"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $page->name }} <span class="caret"></span></a>
  <ul class="dropdown-menu hover" data-name="hovering over 'UL' {{ $page->name }}" data-type="main-nav-dropdown" data-action="hover">
    @foreach($page->children as $page)
        @include('site.layouts.partials_menu', $page)
    @endforeach
  </ul>
</li>
@else
    <li><a href="/{{ $page->url }}.html"  data-name="hovering over 'LI' {{ $page->name }}" data-type="main-nav" class="hover" data-action="hover">{{ $page->name }}</a></li>
@endif
