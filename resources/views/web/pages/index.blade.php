@extends('web.layout.app')
@section('seo_title', __('Quality1 mit neuem Auftritt'))
@if (isset($post))
  @section('seo_description', $post->name . ', ' . $post->company . ' – ' .__('Quality1 mit neuem Auftritt'))
  @section('seo_image', $post->image)
@else
  @section('seo_description', __('Quality1 mit neuem Auftritt. Wir haben unseren Quality1-Auftritt vereinheitlicht und einen frischen Wind in unsere Firmenpräsentation gebracht. Verschiedene historische Marken wurden zu einer gemeinsamen Marke, Quality1, gebündelt und unser POS-Material haben wir entsprechend aktualisiert, weiterentwickelt und aufgefrischt.'))
@endif
@section('content')
<section class="landing-intro">
  <div>
    <h1>{{__('Quality1 mit neuem Auftritt')}}</h1>
    <figure class="landing-intro__visual">
      <a href="javascript:;" class="landing-intro__badge js-btn-badge">
        <span>
          <strong>{!!__('Jetzt mitmachen, Foto hochladen & Überraschung für Ihr Team gewinnen.')!!}</strong>
        </span>
      </a>
      <img src="/assets/img/keyvisual.png" height="1920" width="1920" alt="{{__('Quality1 mit neuem Auftritt')}}">
    </figure>
    <p>{{__('Seit 21 Jahren sind Fahrzeuggarantien unsere Leidenschaft, und wir sind dankbar, dass wir viele von Ihnen als langjährige Partner an unserer Seite haben.') }}</p>
    <p>{!!__('Um Ihnen weiterhin das Beste bieten zu können, entwickeln wir unsere Angebote ständig weiter. Wir haben unseren Auftritt als Quality1 vereinheitlicht. Verschiedene historische Marken wurden in der gemeinsamen Marke <strong>Quality1</strong> gebündelt. Unser POS-Material haben wir entsprechend aktualisiert, weiterentwickelt und aufgefrischt. ') !!}</p>
    <div class="landing-intro__list">
      <p><strong>{{ __('Im Detail bedeutet das:') }}</strong></p>
      <ul>
        <li>{{ __('Die Flyer wurden überarbeitet und sind bereits im Einsatz.') }}</li>
        <li>{{ __('Die Nummernschilder sowie Fahnen wurden entsprechend dem neuen Design erstellt und sind ebenfalls bereits erhältlich.') }}</li>
        <li>{{ __('Das Quality1-Logo kann bei AutoScout24 als Qualitätssiegel angezeigt werden.') }}</li>
      </ul>
    </div>
    <p>{!! __('So optimieren wir den Wiedererkennungswert der Marke Quality1 bei Fahrzeughaltern – das ist unser Ziel. Davon profitiert auch Ihre Firma. Wir sind überzeugt, dass eine einheitliche Markenpräsenz zu einer klareren Positionierung führt. ') !!}</p>
  </div>
</section>
<section class="landing-order">
  <div>
    <h2>{!! __('Neues POS Material') !!}</h2>
    <p>{!! __('Die neuen POS-Materialien können Sie kostenfrei hier bestellen.') !!}</p>
    <div id="app-order">
      <order-form />
    </div>
  </div>
</section>
<section class="landing-participate">
  <div>
    <h2>{!! __('Jetzt mitmachen') !!}</h2>
    <p>{!! __('Wir freuen uns darauf, den vereinheitlichten Auftritt von Quality1 gemeinsam mit Ihnen umzusetzen und unseren Kundinnen und Kunden zu präsentieren. Zeigen Sie uns bis zum <strong>27. Oktober 2023</strong> mit Fotos von Ihrem Betrieb, wie Sie die neu gestalteten POS-Materialien, insbesondere die Nummernschilder und Fahnen, einsetzen.') !!}</p>
    <p>{!! __('Am 31. Oktober 2023 werden wir aus den eingesendeten Bildern <strong>21&nbsp;Gewinner auslosen</strong>. Als Dankeschön für die aktive Unterstützung erhalten die Gewinner eine Überraschung.') !!}</p>
    <p>{!! __('Wir freuen uns auf Ihre Teilnahme und stehen Ihnen bei Fragen gerne zur Verfügung!') !!}</p>
  </div>
</section>
<section class="landing-app" id="app-participate">
  <div>
    @if (isset($post))
      <post-feed :uuid="'{{$post->uuid}}'"></post-feed>
    @else
      <post-feed />
    @endif
  </div>
</section>
@endsection