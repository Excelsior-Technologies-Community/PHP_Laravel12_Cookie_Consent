<!-- Cookie Preferences Modal -->

<div
    class="modal fade"
    id="cookiePreferences"
    tabindex="-1"
    aria-labelledby="cookiePreferencesLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-dark text-white">

                <h5
                    class="modal-title"
                    id="cookiePreferencesLabel"
                >
                    Cookie Preferences
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>

            <form
                method="POST"
                action="{{ route('cookie.update') }}"
            >

                @csrf

                <div class="modal-body">

                    <p class="mb-3">
                        Manage your cookie preferences. Necessary cookies
                        are required for the website to function properly.
                    </p>

                    <!-- Necessary -->

                    <div class="cookie-category required">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <div>

                                <h6 class="mb-1">
                                    Necessary Cookies
                                </h6>

                                <small class="text-muted">
                                    Always Active
                                </small>

                            </div>

                            <span class="badge bg-success">
                                Required
                            </span>

                        </div>

                        <p class="small text-muted mb-2">
                            These cookies are essential for the website
                            and cannot be disabled.
                        </p>

                    </div>

                    <!-- Analytics -->

                    <div class="cookie-category">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <h6 class="mb-1">
                                Analytics Cookies
                            </h6>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="categories[]"
                                    value="analytics"
                                    {{ isset($currentConsent['categories']) && in_array('analytics', $currentConsent['categories']) ? 'checked' : '' }}
                                >

                                <span class="slider"></span>

                            </label>

                        </div>

                        <p class="small text-muted mb-2">
                            Help us understand how visitors interact
                            with our website.
                        </p>

                    </div>

                    <!-- Marketing -->

                    <div class="cookie-category">

                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <h6 class="mb-1">
                                Marketing Cookies
                            </h6>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="categories[]"
                                    value="marketing"
                                    {{ isset($currentConsent['categories']) && in_array('marketing', $currentConsent['categories']) ? 'checked' : '' }}
                                >

                                <span class="slider"></span>

                            </label>

                        </div>

                        <p class="small text-muted mb-2">
                            Used to deliver relevant content and
                            measure marketing performance.
                        </p>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>

                    <button
                        type="button"
                        class="btn btn-warning"
                        onclick="revokeCookieConsent()"
                    >
                        Revoke Consent
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Save Preferences
                    </button>

                </div>

            </form>

            <!-- Separate revoke form -->

            <form
                id="revokeCookieForm"
                method="POST"
                action="{{ route('cookie.revoke') }}"
                class="d-none"
            >
                @csrf
            </form>

        </div>

    </div>

</div>

<script>
    function revokeCookieConsent() {
        if (confirm('Are you sure you want to revoke your consent?')) {
            document.getElementById('revokeCookieForm').submit();
        }
    }
</script>