@include('layouts.header')

    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
              <div class="col-12 ">
                <h4 class="main-title">Profile</h4>                
              </div>
            </div>
            <!-- Breadcrumb end -->

            <div class="row">
              <div class="col-lg-3">
                <!-- profile tabs -->
                <div class="card" >
                  <div class="card-body">
                    <div class="tab-wrapper">
                      <ul class="profile-app-tabs ">
                        <li class="tab-link fw-medium f-s-16 f-w-600 active" data-tab="1"><i class="ti ti-user fw-bold"></i>
                          Profile
                        </li>                                                  
                      </ul>
                    </div>

                  </div>
                </div>
                
              </div>              

              <div class="col-lg-9 col-xxl-9 col-box-4 order-lg--1">
                <div class="card">
                  <div class="card-body">
                    <div class="profile-container">
                      <div class="image-details">
                        <div class="profile-image"></div>
                        <div class="profile-pic">
                          <div class="avatar-upload">
                            <div class="avatar-edit">
                              <input type="file" id="imageUpload" accept=".png, .jpg, .jpeg">
                              <label for="imageUpload"><i class="ti ti-photo-heart"></i></label>
                            </div>
                            <div class="avatar-preview">
                              <div id="imgPreview">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="person-details">
                        <h5 class="f-w-600">{{ Auth::guard('admin')->user()->name ?? 'Ninfa Monaldo' }}
                          <img src="../assets/images/profile-app/01.png" class="w-20 h-20" alt="instagram-check-mark">
                        </h5>
                        <p>Author</p>
                        <div class="details">
                          <div>
                            <h4 class="text-primary">10</h4>
                            <p class="text-secondary">Post</p>
                          </div>
                          <div>
                            <h4 class="text-primary">3.4k</h4>
                            <p class="text-secondary">Follower</p>
                          </div>
                          <div>
                            <h4 class="text-primary">1k</h4>
                            <p class="text-secondary">Following</p>
                          </div>
                        </div>
                        <div class="my-2">
                          <button type="button" class="btn btn-primary b-r-22" id="followButton"> <i class="ti ti-user"></i>
                            Follow</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card mb-5">
                  <div class="card-header">
                    <h5>About Me</h5>
                  </div>
                  <div class="card-body">
                    <p class="text-muted f-s-13">Hello! I am,Ninfa Monaldo Devoted web designer with
                      over five years of experience and a strong understanding of Adobe Creative Suite,
                      HTML5, CSS3 and Java. Excited to bring my exceptional front-end development
                      abilities to the retail industry. </p>
                    <div class="about-list">
                      <div>
                        <span class="fw-medium"><i class="ti ti-briefcase"></i> Work passion</span>
                        <span class="float-end f-s-13 text-secondary">IT Section</span>
                      </div>
                      <div>
                        <span class="fw-medium"><i class="ti ti-mail"></i> Email</span>
                        <span class="float-end f-s-13 text-secondary">{{ Auth::guard('admin')->user()->email ?? 'Ninfa@gmail.com' }}</span>
                      </div>
                      <div>
                        <span class="fw-medium"><i class="ti ti-phone"></i> Contact</span>
                        <span class="float-end f-s-13 text-secondary">{{ Auth::guard('admin')->user()->phone ?? '98XXXXXXXX' }}</span>
                      </div>
                      <div>
                        <span class="fw-medium"><i class="ti ti-cake"></i> Birth of Date</span>
                        <span class="float-end f-s-13 text-secondary">24 Oct</span>
                      </div>
                      <div>
                        <span class="fw-semibold"><i class="ti ti-map-pin"></i> Location</span>
                        <span class="float-end f-s-13 text-secondary">Via Partenope, 117</span>
                      </div>
                      <div>
                        <span class="fw-semibold"><i class="ti ti-device-laptop"></i> Website</span>
                        <span class="float-end f-s-13 text-secondary">Ninfa_devWWW.com</span>
                      </div>
                      <div>
                        <span class="fw-semibold"><i class="ti ti-brand-github"></i> Github</span>
                        <span class="float-end f-s-13 text-secondary">Ninfa_dev</span>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
        </div>
    </main>

@include('layouts.footer')