@extends('blog.partial.app')
@section('title','Blog Details')



@section('content')

@include('blog.partial.hero',['title'=>$blog->name])


  <!--================ Hero sm Banner end =================-->

  <!--================ Start Blog Post Area =================-->
  <section class="blog-post-area section-margin">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
            <div class="main_blog_details">
                <img class="img-fluid" src="{{ asset("storage/$blog->image")}}" alt="">
                <a href="#"><h4>{{ $blog->name }}</h4></a>
                <div class="user_details">
                  <div class="float-right mt-sm-0 mt-3">
                    <div class="media">
                      <div class="media-body">
                        <h5>{{ $blog->user->name }}</h5>
                        <p>{{ $blog->created_at->format("d M Y") }}</p>
                      </div>
                      <div class="d-flex">
                        <img width="42" height="42" src="{{ asset('assets')}}/img/avatar.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
                <p>{{ $blog->description }}</p>

              </div>

              @if (count($blog->comments) > 0 )
              <div class="comments-area">
                  <h4>{{ count($blog->comments) }} Comments</h4>
                @foreach ($blog->comments as $comment )
                <div class="comment-list">
                    <div class="single-comment justify-content-between d-flex">
                        <div class="user justify-content-between d-flex">
                            <div class="thumb">
                                <img src="{{ asset('assets')}}/img/avatar.png" width="50px">
                            </div>
                            <div class="desc">
                                <h5>{{ $comment->name }}</h5>
                                <p class="date">{{ $comment->created_at->format('d M Y ').'at'.$comment->created_at->format('h:m A') }} </p>
                                <p class="comment">
                                   {{ $comment->message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
                  @endif



              <div class="comment-form">
                @if (session("comment-status"))
                <div class="alert alert-success">{{ session("comment-status"); }}</div>
                @endif
                  <h4>Leave a Reply</h4>
                  <form action="{{ route('comment.store') }}" method="post" >
                    @csrf
                      <div class="form-group form-inline">
                        <input type="number" name="blog_id" hidden value="{{ $blog->id }}" >
                        <div class="form-group col-lg-6 col-md-6 name">
                          <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                          <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="form-group col-lg-6 col-md-6 email">
                          <input type="email" class="form-control" name="email" value="{{ old('email') }}"  placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                          <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="subject" value="{{ old('subject') }}"  placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
                          <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>
                      <div class="form-group">
                          <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required="" >{{ old('message') }} </textarea>
                          <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>
                      <button type="submit" class="button submit_btn">Add Comment</button>
                  </form>
              </div>
        </div>
        @include('blog.partial.sidebarr')
      
      </div>
  </section>
  <!--================ End Blog Post Area =================-->

@endsection
