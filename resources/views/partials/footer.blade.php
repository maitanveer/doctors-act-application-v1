<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 mb-4">
                    <a href="{{ route('home') }}" class="footer-logo">
                        <img
                            src="{{ asset('images/Avicena Clincas Logo_Transparent.svg') }}"
                            alt="Avicenna Clinics"
                            style="max-width: 14rem; background: #fff; padding: .5rem; border-radius: .25rem;"
                        >
                    </a>
                    <p class="mt-3 mb-0">
                        Information about the Texas Doctor’s Act (HB 2038) provisional medical license pathway.
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h4>Explore</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('doc-act') }}">Doctors Act Pathway</a></li>
                        <li><a href="{{ route('application') }}">Application</a></li>
                        <li><a href="{{ route('login') }}">Sign In</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h4>Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="tel:2818487979">(281) 848-7979</a></li>
                        <li><a href="mailto:info@ibnsinafoundation.org">info@ibnsinafoundation.org</a></li>
                    </ul>
                    <p class="small mb-0">
                        For current licensing information, consult the Texas Medical Board.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <p class="mb-0">© {{ date('Y') }} Avicenna Clinics. All rights reserved.</p>
        </div>
    </div>
</footer>