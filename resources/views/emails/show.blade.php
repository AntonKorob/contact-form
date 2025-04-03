@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Просмотр письма</h1>
        <a href="{{ route('emails.index') }}" class="btn btn-outline-secondary">
            Назад к списку
        </a>
    </div>
    
    <div class="card">
        <div class="card-header">
            {{ basename($email['file']) }}
        </div>
        <div class="card-body">
            {!! $email['content'] !!}
        </div>
        <div class="card-footer text-muted">
            Создано: {{ date('Y-m-d H:i', $email['created_at']) }}
        </div>
    </div>
</div>
@endsection