@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    @if(Session::has('success'))
                        <div class="col-12 alert alert-success justify-content-center d-flex">
                            <p class="text-center" > {{Session::get('success')}}</p>
                        </div>
                    @endif
                    @if(isset($posts) && $posts -> count() > 0)
                        @foreach($posts as $post)
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <h1> {{$post -> title}} - @if(Auth::id() == $post -> user -> id)   Author @endif</h1>
                                <br>
                                {{$post -> content}}

                                <br>
                                <br>
                                @if(Auth::id() != $post -> user -> id)
                                    <h5>related comments</h5>
                                    @endif
                                @if($post -> comments() -> count() >0)
                                    @foreach($post -> comments  as $_comment)
                                        <p>{{$_comment -> comment}}</p>
                                    @endforeach
                                @endif
                                <br><br>
                                <form method="POST" action="{{route('comment.save')}}"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="post_id" value="{{$post -> id}}">
                                    <div class="form-group">
                                        @if(Auth::id() != $post -> user -> id)
                                        <input type="text" class="form-control" name="post_content">
                                        @error('name_ar')
                                        <small class="form-text text-danger">{{$message}}</small>
                                        @enderror
                                        @endif
                                    </div>


                                    @if(Auth::id() != $post -> user -> id)
                                        <button type="submit" class="btn btn-primary">Add a Reply! </button>
                                    @endif
                                </form>


                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
