<!--
=========================================================
* * Black Dashboard - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/black-dashboard
* Copyright 2019 Creative Tim (https://www.creative-tim.com)


* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="{{url('admin/assets/img/think_wittsy_logo.png')}}">
  <title>
    Think Wittsy
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="{{url('admin/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{url('admin/assets/css/black-dashboard.css?v=1.0.0')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{url('admin/assets/demo/demo.css')}}" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  
</head>
@php $data = App\Admin\UnitSetting::first(); @endphp
<body class="{{$data->panel_background}}">
  <div class="wrapper">
    @include('admin.layouts.sidebar')
    <div class="main-panel">
      <!-- Navbar -->
      @include('admin.layouts.header')
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      @yield('content')
      @include('admin.layouts.footer')
    </div>
  </div>
  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Background</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors text-center">
              <span class="badge filter badge-info active" data-color="blue" ></span>
              <span class="badge filter badge-primary" data-color="primary" ></span>
              <span class="badge filter badge-success" data-color="green" ></span>
              <span class="badge filter dark-badge" data-color="dark" ></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="adjustments-line text-center color-change">
          <span class="color-label">LIGHT MODE</span>
          <span class="badge light-badge mr-2"></span>
          <span class="badge dark-badge dark-mode ml-2"></span>
          <span class="color-label">DARK MODE</span>
        </li>
        {{-- <li class="button-container">
          <a href="https://www.creative-tim.com/product/black-dashboard" target="_blank" class="btn btn-primary btn-block btn-round">Download Now</a>
          <a href="https://demos.creative-tim.com/black-dashboard/docs/1.0/getting-started/introduction.html" target="_blank" class="btn btn-default btn-block btn-round">
            Documentation
          </a>
        </li> --}}
        {{-- <li class="header-title">Thank you for 95 shares!</li> --}}
        {{-- <li class="button-container text-center">
          <button id="twitter" class="btn btn-round btn-info"><i class="fab fa-twitter"></i> &middot; 45</button>
          <button id="facebook" class="btn btn-round btn-info"><i class="fab fa-facebook-f"></i> &middot; 50</button>
          <br>
          <br>
          <a class="github-button" href="https://github.com/creativetimofficial/black-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>
        </li> --}}
      </ul>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{url('admin/assets/js/core/jquery.min.js')}}"></script>
  <script src="{{url('admin/assets/js/core/popper.min.js')}}"></script>
  <script src="{{url('admin/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{url('admin/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
  <!-- Chart JS -->
  <script src="{{url('admin/assets/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{url('admin/assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{url('admin/assets/js/black-dashboard.min.js?v=1.0.0')}}"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{url('admin/assets/demo/demo.js')}}"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
        $("#users_list").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "serverSide": true,
            "ajax": {
                "url": "{{route('admin.users.list')}}",
                "type": "GET", // Adjust the HTTP request method if needed
                "dataType": "json", // Specify the data type you expect from the server
            },
            "columns": [
                { "data": 'DT_RowIndex', "name": 'DT_RowIndex' },
                { "data": 'name', "name": 'name' },
                { "data": "email", "name": 'email' },
                { "data": 'phone', "name": 'phone' },
                {"data": 'status', "name": 'status' },
                // { "data": 'action', "name": 'action', "orderable": false, "searchable": false },
                
            ],
            "processing": true, // Display a loading indicator while loading data
        });

        $("#feedback_list").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "serverSide": true,
            "ajax": {
                "url": "{{route('admin.feedback')}}",
                "type": "GET", 
                "dataType": "json", 
            },
            "columns": [
                { "data": 'DT_RowIndex', "name": 'DT_RowIndex' },
                { "data": 'username', "name": 'username' },
                { "data": "email", "name": 'email' },
                { "data": 'testimonial', "name": 'testimonial' },
                { "data": 'created_at', "name": 'created_at' },
                // { "data": 'action', "name": 'action', "orderable": false, "searchable": false },
                
            ],
            "processing": true, // Display a loading indicator while loading data
        });

    });

  
    
   

    $(document).ready(function() {

      @if(session('success'))
            demo.showNotification('top','right','2','{{ session('success') }}')
        @endif

        @if(session('error'))
        demo.showNotification('top','right','4','{{ session('error') }}')
        @endif

        @if($errors->has('location_name'))
        demo.showNotification('top','right','4','{{ $errors->first('location_name') }}')
        @endif

      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }

          const url = "{{url('admin/update-settings')}}";
          const data = {
              color: new_color,
          };

          // Options for the fetch request
          const options = {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': "{{csrf_token()}}" // Include CSRF token if your application uses it
              },
              body: JSON.stringify(data),
          };
          fetch(url, options)
              .then(response => {
                  if (!response.ok) {
                      if(response.status === 422) {
                        demo.showNotification('top','right','2',`${response.statusText}`)
                      }

                      if(response.status === 500) {
                        demo.showNotification('top','right','4',`${response.statusText}`)
                      }
                      throw new Error(`HTTP error! Status: ${response.status}`);
                  }
                  return response.json();
              })
              .then(data => {
                
                if(data.status == 'success') {
                  demo.showNotification('top','right','2',`${data.message}`)
                }
                  
              })
              .catch(error => {
                  console.log(error)
              });

        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
          const url = "{{url('admin/update-settings')}}";
          const data = {
            bodyColor: 'white-content',
          };

          // Options for the fetch request
          const options = {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': "{{csrf_token()}}" // Include CSRF token if your application uses it
              },
              body: JSON.stringify(data),
          };
          fetch(url, options)
              .then(response => {
                  if (!response.ok) {
                      throw new Error(`HTTP error! Status: ${response.status}`);
                  }
                  return response.json();
              })
              .then(data => {
                
                if(data.status == 'success') {
                  demo.showNotification('top','right','2',`${data.message}`)
                }
                  
              })
              .catch(error => {
                  console.error('Error updating settings:', error);
              });

        });

        $('.dark-mode').click(function() {
          $('body').removeClass('white-content');
          const url = "{{url('admin/update-settings')}}";
          const data = {
              bodyColor: 'dark-content',
          };

          // Options for the fetch request
          const options = {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': "{{csrf_token()}}" // Include CSRF token if your application uses it
              },
              body: JSON.stringify(data),
          };
          fetch(url, options)
              .then(response => {
                  if (!response.ok) {
                      throw new Error(`HTTP error! Status: ${response.status}`);
                  }
                  return response.json();
              })
              .then(data => {
                
                if(data.status == 'success') {
                  demo.showNotification('top','right','2',`${data.message}`)
                }
                  
              })
              .catch(error => {
                  console.error('Error updating settings:', error);
              });

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
      
  </script>
</body>

</html>