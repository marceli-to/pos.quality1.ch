@component('mail::message')
<div style="width: 100%; text-align: left; padding-bottom: 32px;">
  <a href="{{url('/')}}" target="_blank" class="brand">
    <img src="{{url('/')}}/assets/img/logo.png" height="88" width="160" alt="20 years with the best clients" style="display:inline-block; height: 88px; width: 160px;">
  </a>
</div>
<h1>Bestellung POS</h1>
<p>Es wurde eine neue Bestellung aufgegeben:</p>
<div><strong>Artikel</strong></div>
<div class="table table--order">
<table cellspacing="0" cellpadding="0">
  @if ($order->plate_front)
    <tr>
      <td style="width: 180px">Nummernschild vorne</td>
      <td><strong>{{$order->plate_front}} Stk.</strong></td>
    </tr>
  @endif
  @if ($order->plate_back)
    <tr>
      <td style="width: 180px">Nummernschild hinten</td>
      <td><strong>{{$order->plate_back}} Stk.</strong></td>
    </tr>
  @endif
  @if ($order->flag)
    <tr>
      <td style="width: 180px">Quality1 Fahne</td>
      <td><strong>{{$order->flag}} Stk.</strong></td>
    </tr>
  @endif
</table>
</div>
<br>
<div><strong>Bestellt von</strong></div>
<div class="table table--order">
  <table>
    <tr>
      <td style="width: 180px">Firma</td>
      <td><strong>{{$order->company}}</strong></td>
    </tr>
    <tr>
      <td>Vorname, Name</td>
      <td><strong>{{$order->name}}</strong></td>
    </tr>
    <tr>
      <td>Strasse, Nr.</td>
      <td><strong>{{$order->street}}</strong></td>
    </tr>
    <tr>
      <td>PLZ/Ort</td>
      <td><strong>{{$order->zip}}</strong> <strong>{{$order->city}}</strong></td>
    </tr>
    <tr>
      <td>E-Mail</td>
      <td><strong>{{$order->email}}</strong></td>
    </tr>
  </table>
  </div>
@endcomponent
