@section('content')
	<h3>Here is the {{$home->name}}'s family data</h3>
    <p>The home name is {{$home->name }} </p>
    <p>The home email is {{ $home->email }}</p>
    <p>The home's phone number is {{ $home->phone_number }}</p>
    <p>Their address is {{$home->address}}</p>
    <p>Their home teachers are {{$home->team->senior->firstname}} {{$home->team->senior->lastname}} and {{$home->team->junior->firstname}} {{$home->team->senior->lastname}}</p>
    {{ Form::open('homes/'.$home->id, 'DELETE', array('class' => 'form')) }}
	    {{ HTML::to('homes/' . $home->id .'/edit', 'Edit this user', array('id' => 'edit_link', 'class' => 'btn'));}}
		{{ HTML::to('homes', 'Back to home list', array('id' => 'back_link', 'class' => 'btn'));}}
		
		{{Form::submit('Delete user', array('class' => 'btn btn-danger pull-right'))}}
	{{Form::close()}}

@stop