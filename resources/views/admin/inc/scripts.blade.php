@yield('before_scripts')
@stack('before_scripts')

<script src="{{asset("assets_admin/plugins/jquery/jquery.min.js")}}"></script>
<script src="{{asset("assets_admin/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset('assets_admin/js/adminlte.min.js?v=3.2.0')}}"></script>
<script>
    $(function () {
        $.validator.setDefaults({
            submitHandler: function () {
                alert( "Form successful submitted!" );
            }
        });
        $('#quickForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 5
                },
                terms: {
                    required: true
                },
            },
            messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
    // Set active state on menu element
    var full_url = "{{\URL::current()}}";
    var $navLinks = $(".main-sidebar li.nav-item a");
    // First look for an exact match including the search string
    var $curentPageLink = $navLinks.filter(
        function() { return $(this).attr('href') === full_url; }
    );
    // If not found, look for the link that starts with the url
    if(!$curentPageLink.length > 0){
        $curentPageLink = $navLinks.filter( function() {
            if ($(this).attr('href').startsWith(full_url)) {
                return true;
            }
            if (full_url.startsWith($(this).attr('href'))) {
                return true;
            }
            return false;
        });
    }
    // - the actual element is active
    $curentPageLink.each(function() {
        $(this).addClass('active');
    });
</script>

<script>
    function removeRow(id, url){
        if (confirm('Bạn có chắc chắn muốn xóa không?')){
            $.ajax({
                type: 'DELETE',
                datatype: 'JSON',
                data: {id},
                url: url,
                success: function (result){
                    if(result.error === false){
                        alert('Xóa thành công');
                        location.reload();
                    }
                    else{
                        alert('Xóa không thành công');
                    }
                }
            })
        }
    }
</script>
<script>
    CKEDITOR.replace( 'content' );
</script>
@yield('after_scripts')
@stack('after_scripts')