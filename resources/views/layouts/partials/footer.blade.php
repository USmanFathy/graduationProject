<!-- Main Footer -->
<footer class="main-footer">
    <strong>Book Store</strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@stack('js')
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script>
    const userId ="{{auth()->user()->id}}"
</script>
<script src="{{Vite::asset('resources/js/app.js')}}"></script>

</body>
</html>
