@extends('blog.partial.app')
@section('title','Edit Blog\'s')

@section('content')

@include('blog.partial.hero',['title'=>"Edit $blog->name Blog" ])
    @php
      $categories=App\Models\Category::get();
    @endphp


  <!-- ================ contact section start ================= -->
  <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    @if (session('edit-status'))
                <div class="alert alert-success">{{ session('edit-status')  }}</div>
                @endif
                    <h4>Add New Blog </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('blogs.update',['blog' => $blog]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label"></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="enter blog name" value="{{ $blog->name }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label"></label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="image" name="image">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div class="mt-2 text-left">
                            Old Image :  <img src="{{ asset("storage/$blog->image") }}" width="150px" height="100px" alt="">

                            </div>
                        </div>

                        <div class="form-group">
                            <select class="form-control border" id="category_id" name="category_id" >
                                @if (count($categories) > 0 )
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if ($category->id == $blog->category_id)
                                    selected
                                @endif>{{ $category->name }}</option>
                               @endforeach
                                @endif
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label"></label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="enter blog description"  >{{ $blog->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="button button--active button-contactForm">Edit Blog</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	<!-- ================ contact section end ================= -->
@endsection

