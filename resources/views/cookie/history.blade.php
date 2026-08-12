@extends('layouts.app')

@section('title', 'Consent History')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-xl-11">

            <div class="card shadow-sm">

                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

                    <div>
                        <h4 class="mb-0">
                            Cookie Consent History
                        </h4>

                        <small>
                            Audit trail of cookie preference changes
                        </small>
                    </div>

                    <a
                        href="{{ route('cookie.policy') }}"
                        class="btn btn-outline-light btn-sm"
                    >
                        Cookie Policy
                    </a>

                </div>

                <div class="card-body">

                    @if($consents->count())

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

                                <thead class="table-light">

                                    <tr>
                                        <th>#</th>
                                        <th>Date & Time</th>
                                        <th>Action</th>
                                        <th>Necessary</th>
                                        <th>Analytics</th>
                                        <th>Marketing</th>
                                        <th>Consent ID</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($consents as $consent)

                                        @php
                                            $categories = $consent->categories ?? [];
                                        @endphp

                                        <tr>

                                            <td>
                                                {{ $consents->firstItem() + $loop->index }}
                                            </td>

                                            <td>
                                                <strong>
                                                    {{ $consent->created_at->format('d M Y') }}
                                                </strong>

                                                <br>

                                                <small class="text-muted">
                                                    {{ $consent->created_at->format('h:i A') }}
                                                </small>
                                            </td>

                                            <td>

                                                @if($consent->action === 'accepted')

                                                    <span class="badge bg-success">
                                                        Accepted
                                                    </span>

                                                @elseif($consent->action === 'updated')

                                                    <span class="badge bg-primary">
                                                        Updated
                                                    </span>

                                                @elseif($consent->action === 'revoked')

                                                    <span class="badge bg-warning text-dark">
                                                        Revoked
                                                    </span>

                                                @else

                                                    <span class="badge bg-secondary">
                                                        {{ ucfirst($consent->action) }}
                                                    </span>

                                                @endif

                                            </td>

                                            <td>
                                                @if(in_array('necessary', $categories))
                                                    <span class="text-success fw-bold">✓</span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if(in_array('analytics', $categories))
                                                    <span class="text-success fw-bold">✓</span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if(in_array('marketing', $categories))
                                                    <span class="text-success fw-bold">✓</span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>

                                            <td>
                                                <code>
                                                    {{ \Illuminate\Support\Str::limit($consent->consent_id, 22) }}
                                                </code>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="mt-3">
                            {{ $consents->links() }}
                        </div>

                    @else

                        <div class="text-center py-5">

                            <div class="display-5 mb-3">
                                🍪
                            </div>

                            <h5>
                                No consent history found
                            </h5>

                            <p class="text-muted">
                                Cookie preference changes will appear
                                here after users submit their choices.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection