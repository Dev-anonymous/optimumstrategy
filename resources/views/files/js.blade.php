<script src="{{ asset('dash/js/common.min.js') }}"></script>
<script src="{{ asset('dash/js/custom.min.js') }}"></script>
<script src="{{ asset('dash/js/settings.js') }}"></script>
<script src="{{ asset('dash/js/gleek.js') }}"></script>
<script src="{{ asset('dash/js/styleSwitcher.js') }}"></script>
<script>
    @guest
    localStorage.setItem('token', '')
    @endguest
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Accept': 'application/json'
        }
    });

    $('[logout]').click(function() {
        $(this).closest('.header-right').find('.user-img').html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'post',
            url: '{{ route('web.logout') }}',
            success: function(data) {
                localStorage.setItem('token', '');
                location.reload();
            },
            error: function(data) {
                location.reload();
            }
        })
    })
</script>
