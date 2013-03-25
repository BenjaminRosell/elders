 @section('pagebar')
	<section id="wrapper_slider" class="container">
        <h2 class="page_name text_shadow">Settings</h2>
        <h3 class="breadcrumb text_shadow">Home  /  Settings</h3>
    </section><!-- end #wrapper_slider -->
@stop

@section('content')
<table class="table table-striped">
	<thead>
		<td><strong>Setting</strong></td>
		<td><strong>Value</strong></td>
	</thead>
	<tbody>
	@foreach($settings as $setting)
		<tr>
			<td>{{$setting->setting == 'sunday' ? 'What Sunday would you like to use for interviews?' : 'What is the boy of the email to send ?'}}</td>
			<td>{{$setting->value}}</td>
		</tr>
	@endforeach
	</tbody>
</table>

<a href="../../../settings/edit" class="btn btn-inverse"><i class="icon-pencil"></i> Edit this settings</a> 
@stop