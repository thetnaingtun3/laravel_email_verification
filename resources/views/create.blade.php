@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
	<div class="col-md-6 offset-md-3">
		@if($errors->any())
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>
		@endif
		<form action="{{ action('PostController@store') }}" method="post">
			@csrf
			<div class="form-group">
				<label>Name</label>
				<input class="form-control" type="text" name="name" placeholder="Nama Lengkap"/>
			</div>
			<div class="form-group">
				<label>Detail</label>
				<textarea class="form-control" name="detail" placeholder="Detail"></textarea>
			</div>
			<div class="form-group">
				<label>Author</label>
				<input class="form-control" type="text" name="author" placeholder="Pemilik"/>
			</div>
			<button class="btn btn-primary" type="submit">Submit</button>
		</form>
	</div>
</div>
</div>
@endsection
