@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Protected Dashboard</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Note:</strong> This page is protected by the cookie consent middleware.
                        You can only access it if you have accepted the cookie consent.
                    </div>

                    <h5 class="mb-3">Dashboard Content</h5>
                    <p>
                        Welcome to your dashboard! Since you've accepted the cookie consent,
                        you can access all protected areas of the website.
                    </p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Analytics</h5>
                                    <p class="card-text">View your analytics data here.</p>
                                    @php
                                    $consent = json_decode(request()->cookie('cookie_consent'), true);
                                    $analyticsEnabled = isset($consent['categories']) && in_array('analytics', $consent['categories']);
                                    @endphp

                                    @if($analyticsEnabled)
                                    <div class="alert alert-success">
                                        Analytics cookies are enabled. You can track user behavior.
                                    </div>
                                    @else
                                    <div class="alert alert-warning">
                                        Analytics cookies are disabled. Enable them in cookie settings for tracking.
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Marketing</h5>
                                    <p class="card-text">View your marketing campaigns.</p>
                                    @php
                                    $marketingEnabled = isset($consent['categories']) && in_array('marketing', $consent['categories']);
                                    @endphp

                                    @if($marketingEnabled)
                                    <div class="alert alert-success">
                                        Marketing cookies are enabled. You can track campaign performance.
                                    </div>
                                    @else
                                    <div class="alert alert-warning">
                                        Marketing cookies are disabled. Enable them in cookie settings for campaign tracking.
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Cookie Management Links --}}
            <div class="mt-4 text-center">

                <a
                    href="{{ route('cookie.history') }}"
                    class="btn btn-outline-dark me-2">
                    View Consent History
                </a>

                <a
                    href="{{ route('cookie.policy') }}"
                    class="btn btn-outline-primary">
                    Cookie Policy
                </a>

            </div>

        </div>
    </div>
</div>

@endsection
