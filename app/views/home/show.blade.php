@section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">{{$home->name}}</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Users</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
    <p>The home email is <a href="maito:{{$home->email}}">{{ $home->email }}</a></p>
    <p>The home's phone number is {{ $home->phone_number }}</p>
    <p>Their address is {{$home->address}}</p>
    <p>Their home teachers are {{$home->team->senior->first_name}} {{$home->team->senior->last_name}} and {{$home->team->junior->first_name}} {{$home->team->senior->last_name}}</p>
    {{ Form::open('homes/'.$home->id, 'DELETE', array('class' => 'form')) }}
	    {{ HTML::to('homes/' . $home->id .'/edit', 'Edit this user', array('id' => 'edit_link', 'class' => 'btn btn-inverse'));}}
		{{ HTML::to('homes', 'Back to home list', array('id' => 'back_link', 'class' => 'btn btn-inverse'));}}
		
		@if($admin)
			{{Form::submit('Delete user', array('class' => 'btn btn-danger pull-right'))}}
		@endif
	{{Form::close()}}

@stop