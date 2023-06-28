@component('mail::message')
<div style="width: 100%; text-align: left; padding-bottom: 32px;">
  <a href="{{url('/')}}" target="_blank" class="brand">
    <img src="{{url('/')}}/assets/img/logo.png" height="88" width="160" alt="20 years with the best clients" style="display:inline-block; height: 88px; width: 160px;">
  </a>
</div>
<h1>20 years with the best clients</h1>
<p>Vielen Dank für die Teilnahme an der Fotochallenge. Das <a href="{{url('/')}}/{{locale()}}/{{$post->uuid}}" target="_blank">Foto</a> wurde in der Galerie unter <a href="{{url('/')}}/de/{{$post->uuid}}" target="_blank">www.20years.quality1.ch</a> veröffentlicht und kann ab sofort gelikt werden. Viel Glück!</p>
<hr><br>
<p>Merci d’avoir participé au concours photo. La <a href="{{url('/')}}/fr/{{$post->uuid}}" target="_blank">photo</a> a été publiée dans la galerie sur <a href="{{url('/')}}/fr/{{$post->uuid}}" target="_blank">www.20years.quality1.ch</a> et peut dès à présent être likée. Bonne chance!</p>
<hr><br>
<p>Grazie per aver partecipato al concorso fotografico. La <a href="{{url('/')}}/it/{{$post->uuid}}" target="_blank">foto</a> è stata pubblicata nella galleria su <a href="{{url('/')}}/it/{{$post->uuid}}" target="_blank">www.20years.quality1.ch</a> ed è pronta a raccogliere «Mi piace». In bocca al lupo!</p>
@endcomponent
