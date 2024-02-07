{{-- ============= logout link ห้ามลบจ้าา ============= --}}
<script>
    $(document).ready(function () {
        $('#logout-link').click(function (e) {
            e.preventDefault();
            $('#logout-form').submit();
        });
    });
</script>

{{-- ============= Get Current Time ============= --}}
<script type="text/javascript" src="{{ asset('js/displayDateTime.js') }}"></script>