@props(['type' => null, 'message' => null])

@php
    $alertType = $type ?? session('alert_type', 'success');
    $alertMessage = $message ?? session('info');
@endphp

@if ($alertMessage)
    <div class="alert alert-{{ $alertType }}">
        <strong>{{ $alertMessage }}</strong>
    </div>
@endif
