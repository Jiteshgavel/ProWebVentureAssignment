 </div> <!-- .wrapper -->
    <script src="{{ asset('asset/admin/js/jquery.min.js')}}"></script>
    <script src="{{ asset('asset/admin/js/popper.min.js')}}"></script>
    <script src="{{ asset('asset/admin/js/moment.min.js')}}"></script>
    <script src="{{ asset('asset/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('asset/admin/js/simplebar.min.js')}}"></script>
    <script src="{{ asset('asset/admin/js/daterangepicker.js')}}"></script>
    <script src="{{ asset('asset/admin/js/jquery.stickOnScroll.js')}}"></script>
    <script src="{{ asset('asset/admin/js/tinycolor-min.js')}}"></script>
    <script src="{{ asset('asset/admin/js/config.js')}}"></script>

    
 @stack('add-js')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>
</html>