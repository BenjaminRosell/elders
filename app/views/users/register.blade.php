@layout('master')

@section('content')
	{{ Form::open() }}
		{{Form::label('email', 'E-Mail Address')}}
		{{Form::text('email')}} <br>
		{{Form::label('username', 'Username')}}
		{{Form::text('username')}} <br>
		{{Form::label('password', 'Password')}}
		{{Form::password('password')}} <br>
		{{Form::label('firstname', 'Your Firstname')}}
		{{Form::text('firstname')}} <br>
		{{Form::label('lastname', 'Your Lastname')}}
		{{Form::text('lastname')}} <br>
		{{Form::label('phone', 'Your Phone number')}}
		{{Form::text('phone')}} <br>
		{{Form::label('reminders', 'Want to get reminders ?')}}
		{{Form::checkbox('reminder')}} <br>
		{{Form::submit('submit')}}
	{{ Form::close() }}
	{{ HTML::link('register', 'Create an account', array('id' => 'register_link'));}}
@endsection