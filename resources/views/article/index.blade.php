@extends('layouts.app')

@section('content')
	<h1>Ini Halaman artikel</h1>

	@foreach ($articles as $article)
		<p><strong> Judul: {{ $article['title'] }} </strong></p>
		<p> Subject: {{ $article['subject'] }} </p>
	@endforeach


@endsection