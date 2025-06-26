@extends('components.layouts.base')

@section('title', 'Irish Koffe')

@section('content')

<!-- HERO SECTION -->
<section>
    @include('components.carousel')
</section>

<!-- OUR MENU -->
<section>
    @include('components.our_menu')
</section>

<!-- ABOUT US -->
<section>
    @include('components.cerita')
</section>

<!-- GALLERY -->
<section>
    @include('components.galery')
</section>


@endsection
