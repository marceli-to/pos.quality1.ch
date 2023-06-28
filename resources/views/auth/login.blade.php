@extends('web.layout.auth')
@section('seo_title', 'Login')
@section('content')
<section class="auth">
  <div>
    <article>
      <div>
        @if ($errors->any())
          <x-alert type="danger" message="{{__('messages.general_error')}}" />
        @endif
        <form method="POST" class="auth" action="{{ route('login') }}">
          @csrf
          <h1>Login</h1>
          <x-text-field label="E-Mail" type="email" name="email" autocomplete="false" />
          <x-text-field label="Passwort" type="password" name="password" autocomplete="false" />
          <div class="form-buttons align-justify is-auth">
            <x-button label="Anmelden" name="register" btnClass="btn-primary is-inline js-btn-loader" type="submit" />
          </div>
        </form>
      </div>
    </article>
  </div>
</section>
@endsection
