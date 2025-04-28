<!DOCTYPE html>
<html lang="fr">

<head>
    {{-- <script src="https://cdn.jsdelivr.net/npm/eruda"></script>
    <script>
        eruda.init();
    </script> --}}
    <meta name="theme-color" content="#E6BE8A">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }} </title>
    @yield('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('assets/bs5.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/aos/style.css') }}" rel="stylesheet">
</head>

<body class="index-page">
    <x-header />
    <main class="main">
        @yield('body')
    </main>
    <x-footer />

    <script src="{{ asset('assets/aos/js.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bs5.js') }}"></script>
    <script>
        $('#fcontact').submit(function() {
            event.preventDefault();
            var form = $(this);
            var rep = $('#rep', form);
            var btn = $(':submit', form);
            var span = btn.find('span');
            var data = form.serialize();
            $(':input', form).attr('disabled', true);
            span.removeClass().addClass('spinner-border spinner-border-sm');
            rep.stop().slideUp();

            $.ajax({
                url: '{{ route('contact.store') }}',
                data: data,
                type: 'post',
                success: function(r) {
                    rep.removeClass().html(r.message);
                    if (r.success) {
                        rep.addClass('alert alert-success');
                        setTimeout(() => {
                            rep.stop().slideUp();
                        }, 5000);
                        form[0].reset();
                    } else {
                        rep.addClass('alert alert-danger');
                    }
                    rep.stop().slideDown();
                },
                error: function(r) {
                    location.reload();
                }
            }).always(function() {
                $(':input', form).attr('disabled', false);
                span.removeClass();
            });

        });

        @if (!Route::is('home'))
            $('.scrollto').click(function() {
                var href = '{{ route('home') }}';
                location.href = href + '/' + this.hash;
            });
        @endif
        @auth
        $('[logout]').click(function() {
            var el = $(this);
            $.ajax({
                type: 'post',
                url: '{{ route('web.logout') }}',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                },
                success: function(data) {
                    localStorage.setItem('token', '');
                    location.reload();
                },
                error: function(data) {
                    alert('Error during logout.');
                    location.reload();
                }
            })
        });
        @endauth
    </script>
    @yield('js-code')

</body>

</html>
