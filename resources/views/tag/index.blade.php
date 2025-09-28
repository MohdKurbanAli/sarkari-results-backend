@include('layouts.header')

    <main>
        <div class="container-fluid">
            <!-- Breadcrumb start -->
            <div class="row m-1">
              <div class="col-12 d-flex justify-content-between">
                <h4 class="main-title">Tags</h4>                
                <a href="{{ route('tag.create') }}" class="btn btn-primary">Add tag</a>
              </div>

            </div>

            <!-- Breadcrumb end -->

            <!-- Data Table start -->
            <div class="row">

              <!-- Default Datatable start -->
              <div class="col-12 mt-4 mb-4">
                <div class="card ">                  
                  <div class="card-body p-0">
                    <div class="app-datatable-default overflow-auto">
                      <table id="example" class="display app-data-table default-data-table">
                        <thead>
                          <tr>
                            <th width="10px">SR. No.</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created At</th>                            
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name ?? 'NA' }}</td>
                                    <td>
                                        @if ($item->is_active == 1)
                                            <span class="badge text-light-success">Active</span>                                            
                                        @else
                                            <span class="badge text-light-danger">Inactive</span>                                            
                                        @endif
                                    </td>                            
                                    <td> {{ \Carbon\Carbon::parse($item->created_at)->format('D m Y') }} </td>
                                    <td>
                                      <a href="{{ route('tag.edit', ['tag'=>$item]) }}" class="btn btn-light-success icon-btn b-r-4">
                                          <i class="ti ti-edit text-success"></i> 
                                      </a>
                                      <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target="#exampleModalToggle-{{$item->id}}" class="btn btn-light-danger icon-btn b-r-4">
                                          <i class="ti ti-trash"></i>
                                      </a>

                                      <!-- center-modal-start-->
                                      <div class="modal fade" id="exampleModalToggle-{{$item->id}}" aria-hidden="true" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5></h5>
                                              <button type="button" class="btn-close m-0 fs-5" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <div class="row">
                                                <div class="col-lg-3 text-center align-self-center">
                                                  <img src="{{ asset('assets/images/modals/04.png') }}" alt="" class="img-fluid b-r-10">
                                                </div>
                                                <div class="col-lg-9 ps-4">
                                                  <h5>Delete Tag</h5>
                                                  <ul class="mt-3 mb-0 list-disc">
                                                    <li>Are you sure want to delete this Tag?</li>
                                                  </ul>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-light-danger" onclick="deleteById({{$item->id}}, '{{ route('tag.destroy') }}', '{{ csrf_token() }}')">Delete</button>
                                              <button type="button" class="btn btn-light-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- center-modal-end -->

                                    </td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Default Datatable end -->              

            </div>
            <!-- Data Table end -->
        </div>
    </main>


@include('layouts.footer')