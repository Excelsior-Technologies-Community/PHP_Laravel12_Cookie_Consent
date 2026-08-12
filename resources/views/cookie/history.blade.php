@extends('layouts.app')

@section('title', 'Consent History')

@section('content')

<style>
    .consent-page {
        background: #f5f7fb;
        min-height: calc(100vh - 80px);
        padding: 30px 0 50px;
    }

    .consent-card {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
    }

    /* Header */
    .consent-header {
        background: linear-gradient(135deg, #111827, #1f2937);
        padding: 25px 28px;
        color: #fff;
    }

    .consent-header h4 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .consent-header small {
        color: #cbd5e1;
    }

    .header-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    /* Buttons */
    .btn-modern {
        border-radius: 9px;
        padding: 9px 15px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-modern:hover {
        transform: translateY(-1px);
    }

    /* Filter section */
    .filter-box {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 20px;
    }

    .filter-title {
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
    }

    .form-control,
    .form-select {
        border-radius: 9px;
        border: 1px solid #d1d5db;
        min-height: 43px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
    }

    .search-btn {
        min-height: 43px;
        border-radius: 9px;
        font-weight: 600;
    }

    /* Active filters */
    .active-filter {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-left: 4px solid #6366f1;
        border-radius: 10px;
        padding: 12px 15px;
    }

    .filter-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin-left: 5px;
    }

    /* Result information */
    .result-info {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 14px 18px;
    }

    .result-number {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
    }

    /* Table */
    .table-card {
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
    }

    .consent-table {
        margin-bottom: 0;
    }

    .consent-table thead th {
        background: #111827;
        color: #fff;
        border: 0;
        padding: 15px 14px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .consent-table tbody td {
        padding: 15px 14px;
        vertical-align: middle;
        border-color: #eef0f3;
        white-space: nowrap;
    }

    .consent-table tbody tr {
        transition: background 0.15s ease;
    }

    .consent-table tbody tr:hover {
        background: #f8fafc;
    }

    .row-number {
        color: #64748b;
        font-weight: 600;
    }

    .date-main {
        font-weight: 600;
        color: #1f2937;
    }

    .date-time {
        color: #94a3b8;
        font-size: 12px;
    }

    /* Status badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-accepted {
        background: #dcfce7;
        color: #15803d;
    }

    .status-updated {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .status-revoked {
        background: #fef3c7;
        color: #92400e;
    }

    .status-yes {
        background: #dcfce7;
        color: #15803d;
    }

    .status-no {
        background: #fee2e2;
        color: #b91c1c;
    }

    /* Category */
    .category-check {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
    }

    .category-active {
        background: #dcfce7;
        color: #15803d;
    }

    .category-inactive {
        background: #f1f5f9;
        color: #94a3b8;
    }

    /* Code */
    .consent-code {
        background: #f1f5f9;
        color: #475569;
        padding: 6px 8px;
        border-radius: 6px;
        font-size: 11px;
    }

    /* Pagination */
    .modern-pagination {
        margin-top: 22px;
    }

    .modern-pagination .page-link {
        border: 1px solid #e2e8f0;
        color: #475569;
        background: #fff;
        border-radius: 8px !important;
        margin: 0 3px;
        min-width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .modern-pagination .page-link:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #111827;
    }

    .modern-pagination .page-item.active .page-link {
        background: #111827;
        border-color: #111827;
        color: #fff;
    }

    /* Empty state */
    .empty-state {
        padding: 70px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 35px;
        margin: 0 auto 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .consent-page {
            padding: 15px 0 30px;
        }

        .consent-header {
            padding: 20px;
        }

        .filter-box {
            padding: 15px;
        }

        .result-info {
            gap: 10px;
        }

        .consent-header .btn {
            width: 100%;
        }
    }
</style>


<div class="consent-page">

    <div class="container">

        <div class="card consent-card">

            {{-- ================= HEADER ================= --}}
            <div class="consent-header">

                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="header-icon">
                            🍪
                        </div>

                        <div>
                            <h4>
                                Cookie Consent History
                            </h4>

                            <small>
                                Search, filter and manage cookie consent records
                            </small>
                        </div>

                    </div>


                    <div class="d-flex flex-wrap gap-2">

                        <a
                            href="{{ route('cookie.policy') }}"
                            class="btn btn-outline-light btn-modern">
                            Cookie Policy
                        </a>

                        <a
                            href="{{ route('cookie.history.export', request()->query()) }}"
                            class="btn btn-success btn-modern">
                            📥 Export CSV
                        </a>

                    </div>

                </div>

            </div>


            {{-- ================= BODY ================= --}}
            <div class="card-body p-4">


                {{-- ================= FILTERS ================= --}}
                <div class="filter-box mb-4">

                    <div class="filter-title">
                        🔎 Search & Filters
                    </div>

                    <form
                        method="GET"
                        action="{{ route('cookie.history') }}">

                        <div class="row g-3">

                            {{-- Search --}}
                            <div class="col-lg-5 col-md-12">

                                <label class="form-label small fw-bold">
                                    Search
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    class="form-control"
                                    placeholder="Consent ID, IP address or user agent..."
                                    value="{{ request('search') }}">

                            </div>


                            {{-- Action --}}
                            <div class="col-lg-3 col-md-6">

                                <label class="form-label small fw-bold">
                                    Action
                                </label>

                                <select
                                    name="action"
                                    class="form-select">

                                    <option value="">
                                        All Actions
                                    </option>

                                    <option
                                        value="accepted"
                                        {{ request('action') === 'accepted' ? 'selected' : '' }}>
                                        Accepted
                                    </option>

                                    <option
                                        value="updated"
                                        {{ request('action') === 'updated' ? 'selected' : '' }}>
                                        Updated
                                    </option>

                                    <option
                                        value="revoked"
                                        {{ request('action') === 'revoked' ? 'selected' : '' }}>
                                        Revoked
                                    </option>

                                </select>

                            </div>


                            {{-- Category --}}
                            <div class="col-lg-3 col-md-6">

                                <label class="form-label small fw-bold">
                                    Cookie Category
                                </label>

                                <select
                                    name="category"
                                    class="form-select">

                                    <option value="">
                                        All Categories
                                    </option>

                                    <option
                                        value="necessary"
                                        {{ request('category') === 'necessary' ? 'selected' : '' }}>
                                        Necessary
                                    </option>

                                    <option
                                        value="analytics"
                                        {{ request('category') === 'analytics' ? 'selected' : '' }}>
                                        Analytics
                                    </option>

                                    <option
                                        value="marketing"
                                        {{ request('category') === 'marketing' ? 'selected' : '' }}>
                                        Marketing
                                    </option>

                                </select>

                            </div>


                            {{-- Search Button --}}
                            <div class="col-lg-1 col-md-12 d-flex align-items-end">

                                <button
                                    type="submit"
                                    class="btn btn-primary search-btn w-100"
                                    title="Apply filters">
                                    🔍
                                </button>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- ================= ACTIVE FILTERS ================= --}}
                @if(
                request()->filled('search') ||
                request()->filled('action') ||
                request()->filled('category')
                )

                <div class="active-filter mb-4">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                        <div>

                            <strong>
                                Active Filters
                            </strong>

                            @if(request('search'))

                            <span class="filter-badge bg-dark text-white">
                                Search: {{ request('search') }}
                            </span>

                            @endif


                            @if(request('action'))

                            <span class="filter-badge bg-primary text-white">
                                Action: {{ ucfirst(request('action')) }}
                            </span>

                            @endif


                            @if(request('category'))

                            <span class="filter-badge bg-success text-white">
                                Category: {{ ucfirst(request('category')) }}
                            </span>

                            @endif

                        </div>


                        <a
                            href="{{ route('cookie.history') }}"
                            class="btn btn-sm btn-outline-danger">
                            ✕ Clear Filters
                        </a>

                    </div>

                </div>

                @endif


                {{-- ================= RESULT SUMMARY ================= --}}
                <div class="result-info mb-3">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                        <div>

                            <span class="result-number">
                                {{ $consents->total() }}
                            </span>

                            <span class="text-muted">
                                consent record(s) found
                            </span>

                        </div>


                        @if($consents->count())

                        <small class="text-muted">

                            Showing
                            <strong>
                                {{ $consents->firstItem() }}
                            </strong>

                            to

                            <strong>
                                {{ $consents->lastItem() }}
                            </strong>

                            of

                            <strong>
                                {{ $consents->total() }}
                            </strong>

                        </small>

                        @endif

                    </div>

                </div>


                {{-- ================= TABLE ================= --}}
                @if($consents->count())

                <div class="table-card">

                    <div class="table-responsive">

                        <table class="table consent-table">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Date & Time</th>

                                    <th>Action</th>

                                    <th>Consent</th>

                                    <th class="text-center">
                                        Necessary
                                    </th>

                                    <th class="text-center">
                                        Analytics
                                    </th>

                                    <th class="text-center">
                                        Marketing
                                    </th>

                                    <th>IP Address</th>

                                    <th>Consent ID</th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($consents as $consent)

                                @php
                                $categories = $consent->categories ?? [];
                                @endphp

                                <tr>

                                    {{-- Number --}}
                                    <td>
                                        <span class="row-number">
                                            {{ $consents->firstItem() + $loop->index }}
                                        </span>
                                    </td>


                                    {{-- Date --}}
                                    <td>

                                        <div class="date-main">
                                            {{ $consent->created_at->format('d M Y') }}
                                        </div>

                                        <div class="date-time">
                                            {{ $consent->created_at->format('h:i A') }}
                                        </div>

                                    </td>


                                    {{-- Action --}}
                                    <td>

                                        @if($consent->action === 'accepted')

                                        <span class="status-badge status-accepted">
                                            ✓ Accepted
                                        </span>

                                        @elseif($consent->action === 'updated')

                                        <span class="status-badge status-updated">
                                            ↻ Updated
                                        </span>

                                        @elseif($consent->action === 'revoked')

                                        <span class="status-badge status-revoked">
                                            ! Revoked
                                        </span>

                                        @else

                                        <span class="status-badge bg-secondary text-white">
                                            {{ ucfirst($consent->action) }}
                                        </span>

                                        @endif

                                    </td>


                                    {{-- Consent --}}
                                    <td>

                                        @if($consent->consent_given)

                                        <span class="status-badge status-yes">
                                            ✓ Yes
                                        </span>

                                        @else

                                        <span class="status-badge status-no">
                                            ✕ No
                                        </span>

                                        @endif

                                    </td>


                                    {{-- Necessary --}}
                                    <td class="text-center">

                                        @if(in_array('necessary', $categories))

                                        <span class="category-check category-active">
                                            ✓
                                        </span>

                                        @else

                                        <span class="category-check category-inactive">
                                            —
                                        </span>

                                        @endif

                                    </td>


                                    {{-- Analytics --}}
                                    <td class="text-center">

                                        @if(in_array('analytics', $categories))

                                        <span class="category-check category-active">
                                            ✓
                                        </span>

                                        @else

                                        <span class="category-check category-inactive">
                                            —
                                        </span>

                                        @endif

                                    </td>


                                    {{-- Marketing --}}
                                    <td class="text-center">

                                        @if(in_array('marketing', $categories))

                                        <span class="category-check category-active">
                                            ✓
                                        </span>

                                        @else

                                        <span class="category-check category-inactive">
                                            —
                                        </span>

                                        @endif

                                    </td>


                                    {{-- IP --}}
                                    <td>

                                        <code class="consent-code">
                                            {{ $consent->ip_address ?? 'N/A' }}
                                        </code>

                                    </td>


                                    {{-- Consent ID --}}
                                    <td>

                                        <code
                                            class="consent-code"
                                            title="{{ $consent->consent_id }}">

                                            {{ \Illuminate\Support\Str::limit(
                                                        $consent->consent_id,
                                                        22
                                                    ) }}

                                        </code>

                                    </td>

                                </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- ================= NUMBER ONLY PAGINATION ================= --}}
                @if($consents->hasPages())

                <div class="modern-pagination">

                    <nav aria-label="Consent history pagination">

                        <ul class="pagination justify-content-center mb-0">

                            @for(
                            $page = 1;
                            $page <= $consents->lastPage();
                                $page++
                                )

                                <li
                                    class="page-item
                                            {{ $page == $consents->currentPage() ? 'active' : '' }}">

                                    <a
                                        class="page-link"
                                        href="{{ $consents->url($page) }}">

                                        {{ $page }}

                                    </a>

                                </li>

                                @endfor

                        </ul>

                    </nav>

                </div>

                @endif


                @else

                {{-- ================= EMPTY STATE ================= --}}
                <div class="empty-state">

                    <div class="empty-icon">
                        🍪
                    </div>

                    <h5 class="fw-bold">
                        No consent history found
                    </h5>

                    <p class="text-muted mb-4">
                        No records match your current search or filters.
                    </p>

                    <a
                        href="{{ route('cookie.history') }}"
                        class="btn btn-outline-primary btn-modern">

                        ↻ Clear Filters

                    </a>

                </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection