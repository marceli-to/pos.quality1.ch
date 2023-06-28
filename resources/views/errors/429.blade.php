@extends('web.layout.error')
@section('content')
<section class="error">
  <div>
    <h1>Too many requests (429)</h1>
    <p>
      <a href="/" class="btn-primary is-inline"><span>Zurück zur Startseite</span></a>
    </p>
   </div>
</section>
@endsection