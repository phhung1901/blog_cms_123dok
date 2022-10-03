<!DOCTYPE html>
<html lang="en">

@include("client.layout.header")

<body>
<!-- start header -->
@include("client.layout.menu")
<!-- end header -->

<!-- start container -->
@yield("content")
<!-- end container -->

<!-- start footer -->
<div class="footer">

</div>
<!-- end footer -->
</body>

</html>
