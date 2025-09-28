</div>
    </div>
    <!-- Body main section ends -->


    <!-- tap on top -->
    <div class="go-top">
      <span class="progress-value">
        <i class="ti ti-arrow-up"></i>
      </span>
    </div>

    <!-- Footer Section starts-->
    <footer>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-9 col-12">
            <ul class="footer-text">
              <li>
                <p class="mb-0">Copyright © {{ now()->format('Y') }} sarkari results.com All rights reserved 💖</p>
              </li>              
            </ul>
          </div>
          <div class="col-md-3">
            <ul class="footer-text text-end">
              <li> <a href="document.html"> Need Help <i class="ti ti-help"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Section ends-->
  </div>

  <!--customizer-->
  <div id="customizer"></div>

  <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simplebar/simplebar.js') }}"></script>
  <script src="{{ asset('assets/vendor/phosphor/phosphor.js') }}"></script>
  <script src="{{ asset('assets/vendor/vector-map/jquery-jvectormap-2.0.5.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/vector-map/jquery-jvectormap-world-mill.js') }}"></script>
  <script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/cleavejs/cleave.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/js/customizer.js') }}"></script>
  <script src="{{ asset('assets/js/ecommerce_dashboard.js') }}"></script>
  <script src="{{ asset('assets/vendor/prism/prism.min.js') }}"></script>  

  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  
  @yield('page_jsk')

  <script src="{{ asset('assets/js/script.js') }}"></script>
  <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
  <script src="{{ asset('assets/js/data_table.js') }}"></script>
  <script src="{{ asset('assets/js/k-script.js') }}"></script>
    

  <script>

    $(document).ready(function() {
      $('.summernote').summernote({
        height: '300'
      });

      $('.summernote-tiny').summernote();
    });

  </script>


</body>

</html>