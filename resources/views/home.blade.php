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
            <!-- Responce error code start from here -->
            
            @if(count($errors) > 0)
          @foreach($errors->all() as $error)
           <div class="alert alert-danger">{{$error}}</div>
          @endforeach
        @endif

          @if(session('response'))
            <div class="alert alert-success">{{session('response')}}</div>
          @endif

           <!-- Responce error code end here -->
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                      <div class="col-md-4">

                    @if(!empty($profile))
                      <img src="{{ $profile->profile_pic }}" class="avatar" align="center"></br></br>
                      @else
                      <img src="{{ url('images/avatar.png') }}" class="avatar" align="center">
                      <p class="lead" align="center">Please create your profile!</p>
                      @endif

                      @if(!empty($profile))
                     <h5 align="center"><b> Name: </b>{{ $profile->name }}</h5>
                      @else
                      <p></p>
                      @endif

                      @if(!empty($profile))
                      <h5 align="center"><b> Designation: </b>{{ $profile->designation }}</h5>
                      @else
                      <p></p>
                      @endif
                      </div>

                         <div class="col-md-8">
                             @if (count($posts)>0)
                                 @foreach($posts->all() as $post)
                         <h4 style="text-align:center">{{$post->post_title}}</h4><br>
                         <img src="{{$post->post_image}}" alt="post_image"><br><br>
                         <p style="text-align:center">{{substr($post->post_body, 0, 250)}}</p>
                            <ul class="nav nav-pills">
<li role="presentation">
<a href="{{url("/view/{$post->id}")}}">
    <span class="fa fa-eye"> View</span>
</a>
</li>
                            </ul>

                         <cite>Posted on: {{date('M j, Y H:m:i', strtotime($post->updated_at))}}</cite><br>
                                 @endforeach
                                 @else
                                 <p>No post available!</p>
                             @endif

                             {{-- {{$post->likes}} --}}
                         </div>
                         
                     </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

