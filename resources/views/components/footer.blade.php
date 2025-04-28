<footer id="footer" class="footer position-relative dark-background">
    <div class="container">
        <h3 class="sitename text-gold" data-aos="fade-left" data-aos-delay="100">{{ config('app.name') }}<br></h3>
        <p data-aos="fade-right" data-aos-delay="100">Inspiration quotidienne, idées infinies.</p>
        <div class="social-links d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <a href="https://www.facebook.com/share/1AQo2fdNXZ" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="#" onclick="event.preventDefault()"><i class="bi bi-twitter-x"></i></a>
            <a href="#" onclick="event.preventDefault()"><i class="bi bi-instagram"></i></a>
            <a href="#" onclick="event.preventDefault()"><i class="bi bi-skype"></i></a>
            <a href="#" onclick="event.preventDefault()"><i class="bi bi-linkedin"></i></a>
        </div>
        <div class="container">
            <div class="copyright">
                <span>Copyright</span> {{ date('Y') }}
                <strong class="px-1 sitename">
                    {{ config('app.name') }}
                </strong>
                <span>All Rights Reserved</span>
            </div>
        </div>
    </div>
</footer>

<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
</a>
<div id="preloader"></div>
