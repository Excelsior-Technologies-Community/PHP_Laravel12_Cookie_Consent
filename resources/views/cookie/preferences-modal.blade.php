<!-- Cookie Preferences Modal -->
<div class="modal fade" id="cookiePreferences" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Cookie Preferences</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <form method="POST" action="{{ route('cookie.update') }}">
                @csrf
                <div class="modal-body">
                    <p class="mb-3">
                        Manage your cookie preferences. Necessary cookies are required for the website to function properly.
                    </p>

                    <!-- Necessary Cookies -->
                    <div class="cookie-category required">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h6 class="mb-1">Necessary Cookies</h6>
                                <small class="text-muted">Always Active</small>
                            </div>
                            <span class="badge bg-success">Required</span>
                        </div>
                        <p class="small text-muted mb-2">
                            These cookies are essential for the website to function and cannot be disabled.
                        </p>
                        <div class="small">
                            <strong>Cookies used:</strong> laravel_session, XSRF-TOKEN
                        </div>
                    </div>

                    <!-- Analytics Cookies -->
                    <div class="cookie-category">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-1">Analytics Cookies</h6>
                            <label class="switch">
                                <input type="checkbox" name="categories[]" value="analytics" 
                                    {{ isset($currentConsent['categories']) && in_array('analytics', $currentConsent['categories']) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <p class="small text-muted mb-2">
                            Help us understand how visitors interact with our website.
                        </p>
                        <div class="small">
                            <strong>Cookies used:</strong> _ga, _gid
                        </div>
                    </div>

                    <!-- Marketing Cookies -->
                    <div class="cookie-category">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-1">Marketing Cookies</h6>
                            <label class="switch">
                                <input type="checkbox" name="categories[]" value="marketing"
                                    {{ isset($currentConsent['categories']) && in_array('marketing', $currentConsent['categories']) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                        <p class="small text-muted mb-2">
                            Used to deliver relevant advertisements and track marketing performance.
                        </p>
                        <div class="small">
                            <strong>Cookies used:</strong> _fbp
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="POST" action="{{ route('cookie.revoke') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to revoke your consent?')">
                            Revoke Consent
                        </button>
                    </form>
                    <button type="submit" class="btn btn-primary" id="saveCookiePreferences">
                        Save Preferences
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>