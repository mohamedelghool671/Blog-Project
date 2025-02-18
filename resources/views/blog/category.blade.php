@extends('blog.partial.app')

@section('title','Categories')
@section('category-active','active')

@section('content')
    @include('blog.partial.hero',['title'=>$category_name])


  <!--================ Start Blog Post Area =================-->
  <section class="blog-post-area section-margin">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">

                @if (count($blogs) > 0 )
                @foreach ($blogs as $blog )
                <div class="col-md-6">
                    <div class="single-recent-blog-post card-view">
                      <div class="thumb">
                        <img class="card-img rounded-0" src="{{ asset("storage/$blog->image")}}" alt="">
                        <ul class="thumb-info">
                          <li><a href="#"><i class="ti-user"></i>{{ $blog->user->name }}</a></li>
                          <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                        </ul>
                      </div>
                      <div class="details mt-20">
                        <a href="blog-single.html">
                          <h3>{{$blog->name}}</h3>
                        </a>
                        <p>{{ $blog->description }}</p>
                        <a class="button" href="{{ route('blogs.show', ["blog" => $blog]) }}">Read More <i class="ti-arrow-right"></i></a>
                      </div>
                    </div>
                  </div>
                @endforeach

                @endif


          </div>
          <div class="row">
            <div class="col-lg-12">
                @if (isset($blogs) && count($blogs) > 0)
                {{  $blogs->links() }}
                @endif
            </div>
          </div>
        </div>

      @include('blog.partial.sidebarr')
      </div>
  </section>
  <!--================ End Blog Post Area =================-->
@endsection



