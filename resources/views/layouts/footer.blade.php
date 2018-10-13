<!-- Footer -->
<footer class="site-footer">
    <div class="site-footer-legal">© {{date("Y")}} <a href="">{{ config('app.name', 'Quick Collect') }}</a></div>
    <div class="site-footer-right">
    Powered by <a href="">{{ config('app.name', 'Quick Collect') }}</a>
    </div>
</footer>

<!-- Core  -->
<script src="{{URL::asset('/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
<script src="{{URL::asset('/global/vendor/jquery/jquery.js') }}"></script>
<script src="{{URL::asset('/global/vendor/popper-js/umd/popper.min.js') }}"></script>
<script src="{{URL::asset('/global/vendor/bootstrap/bootstrap.js') }}"></script>
<script src="{{URL::asset('/global/vendor/animsition/animsition.js') }}"></script>
<script src="{{URL::asset('/global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{URL::asset('/global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
<script src="{{URL::asset('/global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>
<script src="{{URL::asset('/global/vendor/ashoverscroll/jquery-asHoverScroll.js') }}"></script>
<script src="{{URL::asset('/global/vendor/waves/waves.js') }}"></script>

<!-- Plugins -->
<script src="{{URL::asset('/global/vendor/switchery/switchery.js') }}"></script>
<script src="{{URL::asset('/global/vendor/intro-js/intro.js') }}"></script>
<script src="{{URL::asset('/global/vendor/screenfull/screenfull.js') }}"></script>
<script src="{{URL::asset('/global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>

<!-- Scripts -->
<script src="{{URL::asset('/global/js/Component.js') }}"></script>
<script src="{{URL::asset('/global/js/Plugin.js') }}"></script>
<script src="{{URL::asset('/global/js/Base.js') }}"></script>
<script src="{{URL::asset('/global/js/Config.js') }}"></script>

<script src="{{URL::asset('/assets/js/Section/Menubar.js') }}"></script>
<script src="{{URL::asset('/assets/js/Section/GridMenu.js') }}"></script>
<script src="{{URL::asset('/assets/js/Section/Sidebar.js') }}"></script>
<script src="{{URL::asset('/assets/js/Section/PageAside.js') }}"></script>
<script src="{{URL::asset('/assets/js/Plugin/menu.js') }}"></script>

<script src="{{URL::asset('/global/js/config/colors.js') }}"></script>
<script src="{{URL::asset('/assets/js/config/tour.js') }}"></script>
<script>Config.set('assets', '{{ URL::asset('/assets')}}' );</script>

@yield('pagescript_bot')
@yield('jsscript')
</body>
</html>
