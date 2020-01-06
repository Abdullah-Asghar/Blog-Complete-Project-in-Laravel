@extends('layouts.app')
<style type="text/css">
    
.avatar{
    border-radius: 100%;
    max-width: 100%;
}

</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('response'))
            <div class="alert alert-success">{{session('response')}}</div>
          @endif
            <!-- Responce error code start from here -->

           <!-- Responce error code end here -->
            <div class="card">
                <div class="card-header">View</div>

                <div class="card-body">
                         <div class="col-md-8">
                             @if (count($posts)>0)
                                 @foreach($posts->all() as $post)
                         <h4 style="text-align:center">{{$post->post_title}}</h4><br>
                         <img src="{{$post->post_image}}" alt="post_image"><br><br>
                         <p style="text-align:center">{{$post->post_body}}</p>
                            <ul class="nav nav-pills">
                     <li role="presentation">
                      <a href="{{url("/like/{$post->id}")}}">
                      <span class="fa fa-thumbs-up"> like ({{$likeCtr}})</span>
                    </a>
                    </li> &nbsp;&nbsp;&nbsp;
                    <li role="presentation">
                      <a href="{{url("/comment/{$post->id}")}}">
                      <span class="fa fa-comment-o"> Comment</span>
                    </a>
                    </li>
                            </ul>
                                 @endforeach
                                 @else
                                 <p>No post available!</p>
                             @endif

                        <form method="post" action='{{url("/comment/{$post->id}")}}'>
                            {{ csrf_field() }}
                        <div class="form-group">
<textarea name="comment" id="comment" rows="6" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
<button type="submit" class="btn btn-success btn-lg btn-block">Post Comment</button>
                        </div>
                        </form>
                        <h1>COMMMENS</h1>

                        @if (count($comments)>0)
                                 @foreach($comments->all() as $comment)
                             <p>{{$comment->comment}}</p>
                             <p>Posted By: {{$comment->name}}</p>
                         
                                 @endforeach
                                 @else
                                 <p>No post available!</p>
                             @endif          

                         </div>
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection

