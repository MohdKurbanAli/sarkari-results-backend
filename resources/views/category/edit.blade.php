@include('layouts.header')

    <main>
        <div class="container-fluid">
            
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Category</h5>
                        </div>
                        <div class="card-body">
                            <form class="app-form" id="category-create" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Category Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control"
                                                    placeholder="Enter Category Name" name="name" id="name" value="{{ $category->name ?? old('name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Slug <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control"
                                                    placeholder="" name="slug" id="slug" value="{{  $category->slug ?? old('slug') }}" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Description </label>
                                            <textarea name="description" id="description" rows="5" class="form-control summernote" type="text">{{ $category->description ?? old('description') }}</textarea>                                            
                                        </div>
                                    </div>    
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Title <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control"
                                                    placeholder="Meta Title" name="meta_title" id="meta_title" value="{{ $category->meta_title ?? old('meta_title') }}" >
                                        </div>
                                    </div>   
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description <span style="color: red;">*</span></label>
                                            <textarea name="meta_description" id="meta_description" rows="2" class="form-control" type="text">{{ $category->meta_description ?? old('meta_description') }}</textarea>                                            
                                        </div>
                                    </div>  

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Keywords <span style="color: red;">*</span></label>
                                            <textarea name="meta_keywords" id="meta_keywords" rows="2" class="form-control" type="text">{{ $category->meta_keywords ?? old('meta_keywords') }}</textarea>                                            
                                        </div>
                                    </div>  

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Page Header Scripts <span style="color: red;">*</span></label>
                                            <textarea name="page_header_script" id="page_header_script" rows="3" class="form-control" type="text">{{ $category->page_header_script ?? old('page_header_script') }}</textarea>                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Page Footer Scripts <span style="color: red;">*</span></label>
                                            <textarea name="page_footer_script" id="page_footer_script" rows="3" class="form-control" type="text">{{ $category->page_footer_script ?? old('page_footer_script') }}</textarea>                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Active Status</label>
                                        <select class="form-select" id="status" name="is_active" >
                                            <option value="1" {{ $category->is_active == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $category->is_active == 0 ? 'selected' : '' }}>Inactive</option>                                            
                                        </select>
                                    </div>                                    
                                    
                                    <div class="col-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary" id="submitbtn">Submit</button>
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

                $('#name').on('keyup', function(e){
                    let nameval = $(this).val();
                    let slug = slugify(nameval);
                    $('#slug').val(slug);
                });

                $('#category-create').submit(function (e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    $('#submitbtn').text('Submitting...');
                    $.ajax({
                        type: "post",
                        url: "{{ route('category.update', ['category'=>$category]) }}",
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,                         
                        success: function (data) {
                            $('#submitbtn').text('Submit');                            
                            if(data == 1){
                                toastr.success('Category updated successfully!');
                                setTimeout(function () {
                                    window.location.href = "{{ route('category.index') }}";                            
                                }, 2000);                                                      
                            }else{
                                toastr.error('Something went wrong!');
                            }
                        },
                        error: function (xhr, status, error) {
                            $('#submitbtn').text('Submit');
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