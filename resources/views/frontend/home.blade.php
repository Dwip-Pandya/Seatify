@extends('frontend.layout')
@section('title','Welcome')
@section('page-title','Latest Events')

@section('content')
<div class="row">
@foreach($events as $event)
  <div class="col-md-4">
    <div class="card mb-3">
      <img src="{{ asset('events/'.$event->image) }}" class="card-img-top" alt="{{ $event->name }}">
      <div class="card-body">
        <h5 class="card-title">{{ $event->name }}</h5>
        <p class="card-text">{{ Str::limit($event->description, 80) }}</p>
        <a href="{{ route('frontend.events.show', $event->event_id) }}" class="btn btn-primary">Details</a>
      </div>
    </div>
  </div>
@endforeach
</div>
@endsection
