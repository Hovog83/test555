@if ($paginator->lastPage() > 1)
<ul class="pagination custom-list pull-right">
    <li >
        <a href="{{ $paginator->url(1) }}" class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}"><</a>
    </li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li >
            <a href="{{ $paginator->url($i) }}" class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
        </li>
    @endfor
    <li >
        <a href="{{ $paginator->url($paginator->currentPage()+1) }}" class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" >></a>
    </li>
</ul>
@endif


