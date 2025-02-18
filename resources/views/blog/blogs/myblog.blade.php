@extends('blog.partial.app')
@section('title','My Blog')

@section('content')

@include('blog.partial.hero',['title'=>'My Blog '])
    @php
      $categories=App\Models\Category::get();
    @endphp


<!-- My-Blog section start -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="container p-4">
                    @if (session("delete-status"))
                        <div class="alert alert-success">{{ session("delete-status") }}</div>
                    @endif

                    <table class="table table-bordered table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($blog) > 0)
                                @foreach ($blog as $my_blog)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            <a href="{{ route('blogs.show', ['blog' => $my_blog]) }}" target="_blank">
                                                {{ $my_blog->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('blogs.edit', ['blog' => $my_blog]) }}"
                                               class="btn btn-sm btn-primary mr-2" target="__blank">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('blogs.destroy', ['blog' => $my_blog]) }}"
                                                  method="post" class="d-inline" id="delete-form-{{ $my_blog->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" onclick="confirmDelete({{ $my_blog->id }})"
                                                   class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No blogs available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @if (count($blog) > 0)
                        <div class="d-flex justify-content-center">
                            {{ $blog->render("pagination::bootstrap-4") }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- My-Blog section end -->

<!-- إضافة FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- إضافة JavaScript لطلب التأكيد -->
<script>
    function confirmDelete(blogId) {
        // طلب تأكيد من المستخدم
        if (confirm('Are you sure you want to delete this blog?')) {
            // إذا وافق المستخدم، إرسال النموذج للحذف
            document.getElementById('delete-form-' + blogId).submit();
        }
    }
</script>

<!-- My-Blog section end -->


@endsection

