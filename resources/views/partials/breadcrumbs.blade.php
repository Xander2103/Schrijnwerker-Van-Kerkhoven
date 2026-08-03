{{--
    Visible breadcrumb trail.

    Expects $crumbs: array of ['label' => string, 'url' => string|null].
    The last item carries aria-current and is rendered without a link.
--}}
@php $crumbs ??= []; @endphp

@if(count($crumbs) > 1)
    <nav class="breadcrumbs" aria-label="{{ $breadcrumbsAria ?? __('regions.common.breadcrumb_aria') }}">
        <ol class="breadcrumbs-list" role="list">
            @foreach($crumbs as $crumb)
                <li class="breadcrumbs-item">
                    @if(!$loop->last && !empty($crumb['url']))
                        <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                        <span class="breadcrumbs-sep" aria-hidden="true">/</span>
                    @else
                        <span aria-current="page">{{ $crumb['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
