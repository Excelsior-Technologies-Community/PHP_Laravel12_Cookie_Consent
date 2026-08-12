@extends('layouts.app')

@section('title', 'Cookie Policy')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <div class="card shadow-sm">

                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        Cookie Policy
                    </h4>
                </div>

                <div class="card-body">

                    <div class="mb-4">
                        <h5>What are cookies?</h5>

                        <p class="text-muted">
                            Cookies are small text files stored on your
                            device when you visit a website. They help
                            websites remember your preferences and
                            provide a better browsing experience.
                        </p>
                    </div>

                    <hr>

                    <div class="cookie-category required">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h5 class="mb-1">
                                    Necessary Cookies
                                </h5>

                                <span class="badge bg-success">
                                    Always Active
                                </span>
                            </div>

                            <span class="badge bg-primary">
                                Required
                            </span>

                        </div>

                        <p class="text-muted mt-3 mb-0">
                            Necessary cookies are required for the
                            website to function correctly. They cannot
                            be disabled through cookie preferences.
                        </p>

                    </div>

                    <div class="cookie-category">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h5 class="mb-1">
                                    Analytics Cookies
                                </h5>

                                <span class="badge bg-secondary">
                                    Optional
                                </span>
                            </div>

                        </div>

                        <p class="text-muted mt-3 mb-0">
                            Analytics cookies help us understand how
                            visitors interact with the website and help
                            improve website performance.
                        </p>

                    </div>

                    <div class="cookie-category">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <h5 class="mb-1">
                                    Marketing Cookies
                                </h5>

                                <span class="badge bg-secondary">
                                    Optional
                                </span>
                            </div>

                        </div>

                        <p class="text-muted mt-3 mb-0">
                            Marketing cookies may be used to understand
                            campaign performance and provide more
                            relevant content.
                        </p>

                    </div>

                    <hr>

                    <div class="alert alert-info">

                        <strong>Your preferences are under your control.</strong>

                        <p class="mb-0 mt-2">
                            You can change or revoke your cookie
                            preferences at any time using Cookie Settings.
                        </p>

                    </div>

                    <div class="d-flex flex-wrap gap-2">

                        <button
                            type="button"
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#cookiePreferences"
                        >
                            Manage Cookie Preferences
                        </button>

                        <a
                            href="{{ route('home') }}"
                            class="btn btn-outline-secondary"
                        >
                            Back to Home
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection