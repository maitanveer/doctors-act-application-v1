@extends('layouts.app')

@section('title', 'Thank You')

@section('content')
<div class="container" style="margin-top:2rem">
    <div class="form-preview">
        <h2>Thank you — Application Received</h2>
        <p>We have received your application. Your Application ID has been emailed to you. We will contact you with next steps.</p>
        <a href="/" class="btn-next" style="display:inline-block; margin-top:10px;">Return Home</a>
    </div>
</div>
@endsection
