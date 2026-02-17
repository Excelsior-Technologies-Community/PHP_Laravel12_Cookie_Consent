@extends('layouts.app')

@section('title', 'Cookie Consent')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Cookie Consent</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cookie.accept') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <h5>Cookie Preferences</h5>
                            <p class="text-muted">
                                We use cookies to help you navigate efficiently and perform certain functions. 
                                You will find detailed information about all cookies under each consent category below.
                            </p>
                        </div>

                        <!-- Necessary Cookies -->
                        <div class="cookie-category required">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Necessary Cookies</h6>
                                <label class="switch">
                                    <input type="checkbox" name="categories[]" value="necessary" checked disabled>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="small text-muted mb-0">
                                These cookies are required for the website to function properly. They cannot be disabled.
                            </p>
                        </div>

                        <!-- Analytics Cookies -->
                        <div class="cookie-category">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Analytics Cookies</h6>
                                <label class="switch">
                                    <input type="checkbox" name="categories[]" value="analytics">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="small text-muted mb-0">
                                These cookies help us understand how visitors interact with our website by collecting and reporting information anonymously.
                            </p>
                        </div>

                        <!-- Marketing Cookies -->
                        <div class="cookie-category">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Marketing Cookies</h6>
                                <label class="switch">
                                    <input type="checkbox" name="categories[]" value="marketing">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <p class="small text-muted mb-0">
                                These cookies are used to deliver relevant advertisements and track marketing campaign performance.
                            </p>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="submit" name="cookie_consent" value="reject" class="btn btn-outline-secondary">
                                Reject All
                            </button>
                            <button type="submit" name="cookie_consent" value="accept" class="btn btn-primary">
                                Accept Selected
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection