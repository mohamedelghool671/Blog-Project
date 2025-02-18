    <!-- Start Blog Post Siddebar -->
    @php

    $Categories=App\Models\Category::get();
    $recentBlog=App\Models\Blog::latest()->limit(3)->get();
    @endphp
    <div class="col-lg-4 sidebar-widgets">
        <div class="widget-wrap">
          <div class="single-sidebar-widget newsletter-widget">
            <h4 class="single-sidebar-widget__title">Newsletter</h4>
            @if (session('status'))

            <div class="alert alert-success"> {{ session('status') }}</div>

            @endif
            <form action="{{ route('subscriber.store') }}" method="post">
                @csrf
            <div class="form-group mt-30">
              <div class="col-autos">
                <input type="text" name="email" class="form-control" id="inlineFormInputGroup" placeholder="Enter email" onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Enter email'" value="{{ old('email') }}">
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
              </div>
            </div>
            <button name="submit" class="bbtns d-block mt-20 w-100">Subcribe</button>
        </form>
          </div>

        @if (count($Categories) > 0)
        <div class="single-sidebar-widget post-category-widget">
            <h4 class="single-sidebar-widget__title">Catgory</h4>
            <ul class="cat-list mt-20">
              @foreach ($Categories as $category )
              <li>
                <a href="{{ route('blog.category',["id" => $category->id]) }}" class="d-flex justify-content-between">
                  <p>{{ $category->name }}</p>
                  <p>({{ count($category->blogs) }})</p>
                </a>
              </li>
              @endforeach
            </ul>
          </div>
          @else
         <div class="alert alert-primary">No categories</div>
        @endif
          @if (count($recentBlog) > 0)

          <div class="single-sidebar-widget popular-post-widget">
              <h4 class="single-sidebar-widget__title">Recent Post</h4>
              @foreach ($recentBlog as $blog )

              <div class="popular-post-list">
                  <div class="single-post-list">
                      <div class="thumb">
                          <img class="card-img rounded-0" src="{{ asset("storage/$blog->image")}}" alt="">
                          <ul class="thumb-info">
                              <li>{{ $blog->user->name }}</li>
                              <li>{{ $blog->created_at->format("d M Y h:m") }}</li>
                            </ul>
                        </div>
                        <div class="details mt-20">
                            <a href="{{ route('blogs.show', ["blog" => $blog]) }}">
                                <h6>{{ $blog->name }}</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <!-- End Blog Post Siddebar -->
