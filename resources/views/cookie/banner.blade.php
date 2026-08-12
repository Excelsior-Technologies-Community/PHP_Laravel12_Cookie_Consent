<div class="cookie-banner">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h5 class="text-warning mb-2">
                    🍪 Cookie Consent
                </h5>

                <p class="mb-md-0">

                    We use cookies to enhance your browsing experience,
                    serve personalized content, and analyze our traffic.

                    <a
                        href="{{ route('cookie.policy') }}"
                        class="text-warning"
                    >
                        Learn more
                    </a>

                </p>

            </div>

            <div class="col-md-4 text-md-end mt-3 mt-md-0">

                {{-- Open Cookie Settings --}}
                <button
                    type="button"
                    class="btn btn-outline-light me-2"
                    data-bs-toggle="modal"
                    data-bs-target="#cookiePreferences"
                >
                    Settings
                </button>

                {{-- Accept All --}}
                <form
                    method="POST"
                    action="{{ route('cookie.accept') }}"
                    class="d-inline"
                >
                    @csrf

                    <input
                        type="hidden"
                        name="cookie_consent"
                        value="accept"
                    >

                    <input
                        type="hidden"
                        name="categories[]"
                        value="necessary"
                    >

                    <input
                        type="hidden"
                        name="categories[]"
                        value="analytics"
                    >

                    <input
                        type="hidden"
                        name="categories[]"
                        value="marketing"
                    >

                    <button
                        type="submit"
                        class="btn btn-warning"
                    >
                        Accept All
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

