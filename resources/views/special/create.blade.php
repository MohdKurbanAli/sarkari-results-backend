@include('layouts.header')

    <main>
        <div class="container-fluid">
            
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add New Special Post link</h5>
                        </div>
                        <div class="card-body">
                            <form class="special-form" id="special-form" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Post Name <span style="color: red;">*</span></label>
                                            <textarea name="name" id="name" class="form-control summernote" required>{{ old('name') }}</textarea>                                            
                                        </div>
                                    </div>                                    

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Category</label>
                                            <select class="form-select" id="category" >
                                                <option value="">Choose Category </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>                                                
                                                @endforeach                                                                                        
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Post <span style="color: red;">*</span></label>
                                            <select class="form-select" id="post_id" name="post_id" >                                                
                                                <option value="">Choose One</option>                                                                                                
                                            </select>                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-md-6">
                                        <label class="form-label">Active Status</label>
                                        <select class="form-select" id="status" name="is_active" >
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>                                            
                                        </select>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary" id="submitbtn">Save</button>
                                            <button type="reset" class="btn btn-secondary" id="resetbtn">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </main>

    @section('page_jsk')
    
        <script>
            $(document).ready(function () {

                $('#category').on('change', function(e){
                    let category_id = $(this).val();
                    console.log(category_id);
                    
                    $.ajax({
                        url: "{{ route('special.fetch_category') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            category_id: category_id,
                        },                                                                      
                        success: function (data) {                                                     
                            if(data.status == true){
                                toastr.success(data.message);
                                $('#post_id').empty();
                                
                                data.data.forEach(element => {                                    
                                    let newOption = `<option value="${element.id}">${element.title}</option>`;                                
                                    $('#post_id').append(newOption);
                                    newOption = '';
                                });
                                
                            }else{
                                $('#post_id').empty();
                                toastr.warning(data.message);
                            }
                        },
                        error: function (xhr, status, error) {                            
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                toastr.error(xhr.responseJSON.message);
                            } else {
                                toastr.error('An unexpected error occurred.');
                            }
                        }
                    });

                });

                $('#special-form').submit(function (e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    $('#submitbtn').text('Saving...');
                    $.ajax({
                        type: "post",
                        url: "{{ route('special.store') }}",
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,                         
                        success: function (data) {
                            $('#submitbtn').text('Save');                            
                            if(data.status == true){
                                toastr.success(data.message);
                                setTimeout(function () {
                                    window.location.href = "{{ route('special.index') }}";                            
                                }, 2000);                                                      
                            }else{
                                toastr.error(data.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            $('#submitbtn').text('Save');
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                if (xhr.responseJSON.errors.username) {
                                    $('#name').text(xhr.responseJSON.errors.name);
                                } else {
                                    $('#name').text(''); 
                                }
                            }

                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                toastr.error(xhr.responseJSON.message);
                            } else {
                                toastr.error('An unexpected error occurred.');
                            }
                        }
                    });
                });
            });
        </script>
    
    @endsection

@include('layouts.footer')