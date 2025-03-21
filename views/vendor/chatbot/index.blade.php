@extends('layouts.app')

@section('styles')
<link href="{{ asset('vendor/chatbot/css/chatbot.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Chat con MaIA</h5>
                </div>
                <div class="card-body chat-window" id="chat-messages">
                    <!-- Los mensajes se cargarán aquí dinámicamente -->
                </div>
                <div class="card-footer">
                    <form id="chat-form" class="d-flex gap-2">
                        <input type="text" class="form-control" id="message-input" placeholder="Escribe tu mensaje...">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
<script src="{{ asset('vendor/chatbot/js/chatbot.js') }}"></script>
@endsection
