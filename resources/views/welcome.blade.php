@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Welcome to Laravel Cookie Consent Demo</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <h5 class="mb-3">What is Cookie Consent?</h5>
                    <p>
                        Cookie consent is a legal requirement under GDPR and other privacy laws that requires 
                        websites to obtain consent from visitors before storing or retrieving any information 
                        on their computer or device.
                    </p>

                    <h5 class="mb-3 mt-4">Current Cookie Status</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Cookie</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cookie Consent</td>
                                    <td>
                                        @if(request()->cookie('cookie_consent'))
                                            <span class="badge bg-success">Consent Given</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if(request()->cookie('cookie_consent'))
                        <div class="mt-4">
                            <h6>Your Current Preferences:</h6>
                            <pre class="bg-light p-3 rounded"><code>{{ json_encode(json_decode(request()->cookie('cookie_consent')), JSON_PRETTY_PRINT) }}</code></pre>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection