<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.user.header')

<body>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
    <div id="wrapper">
        @include('layouts.user.userSidebar')

         <div class="content-page"> 
            @include('layouts.user.usertopbar')
            @yield('content')
            <footer class="footer">
                {{ year() }} © Yankeekicks - Powered by: <a target="_blank" href="https://store.yankeekicks.com/" class="text-danger">Yankeekicks</a>
            </footer>
         </div> 

        
    </div>

    @yield('script')
    <!-- jQuery  -->
    <script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('theme/assets/js/waves.js') }}"></script>
    <script src="{{ asset('theme/assets/js/jquery.slimscroll.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('theme/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('theme/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    {{-- Select2 --}}
    <script src="{{ asset('theme/plugins/select2/js/select2.min.js') }}"></script>


    <!-- KNOB JS -->
    <!--[if IE]>
    <script type="text/javascript" src="plugins/jquery-knob/excanvas.js"></script>
    <![endif]-->
    <script src="{{ asset('theme/plugins/jquery-knob/jquery.knob.js') }}"></script>

    <!-- Counter Up  -->
    <script src="{{ asset('theme/plugins/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/counterup/jquery.counterup.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('theme/assets/js/jquery.core.js') }}"></script>
    <script src="{{ asset('theme/assets/js/jquery.app.js') }}"></script>

    {{-- Emoji --}}
    <script src="{{ asset('theme/plugins/emoji/emojionearea.min.js') }}"></script>
        <script type="text/javascript">
            // Textarea Emoji
            $(document).ready(function() {
                $("#emojionearea1").emojioneArea({
                pickerPosition: "left",
                tonesStyle: "bullet"
              });
                $("#emojionearea2").emojioneArea({
                pickerPosition: "bottom",
                tonesStyle: "radio"
              });
                $("#emojionearea3").emojioneArea({
                pickerPosition: "left",
                filtersPosition: "bottom",
                tonesStyle: "square"
              });
                $("#emojionearea4").emojioneArea({
                pickerPosition: "bottom",
                filtersPosition: "bottom",
                tonesStyle: "checkbox"
              });
                $("#emojionearea5").emojioneArea({
                pickerPosition: "top",
                filtersPosition: "bottom",
                tones: false,
                autocomplete: false,
                inline: true,
                hidePickerOnBlur: false
              });
            });
        </script>
        <script>
          $(window).on('load', function() { // makes sure the whole site is loaded 
  $('#status').fadeOut(); // will first fade out the loading animation 
  $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
  $('body').delay(350).css({'overflow':'visible'});
});
        </script>

<script>
  $('.shower').css({'width':'500px', 'position':'fixed' , 'top':'0' , 'right' : '0' , 'margin-top':'10px' , 'margin-right':'10px'});
  
  $('.shower').click(function(){
    $('.shower').hide(1000);
  });
</script>
</body>
</html>