@extends('layouts.app')

@section('title', $pageTitle . ' - Page Unavailable')

@section('content')
    <section class="container py-5" aria-labelledby="unavailable-heading">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 id="unavailable-heading">{{ $pageTitle }} is not available</h1>
                <p class="lead">
                    This page’s original content is not present in the current project, so it cannot be displayed.
                </p>
                <div class="d-flex flex-wrap justify-content-center" style="gap: .75rem;">
                    <a class="btn btn-primary" href="{{ route('doc-act') }}">View the Doctors Act pathway</a>
                    <a class="btn btn-outline-primary" href="{{ route('application') }}">Go to the application</a>
                </div>
            </div>
        </div>
    </section>
@endsection
