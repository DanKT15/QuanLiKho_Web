@include('giaodien.header')

@isset($page)
    @include('giaodien.'.$page)
@endisset

@include('giaodien.footer')