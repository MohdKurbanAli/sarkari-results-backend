@include('layouts.header')

    <main>
        <div class="container-fluid">
            
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add New Post</h5>
                        </div>
                        <div class="card-body">
                            <form class="app-form" id="post-create" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Title <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control"
                                                    placeholder="Enter post title" name="title" id="title" value="{{ old('title') }}" required>                                            
                                        </div>
                                        @error('title')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Slug <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control"
                                                    placeholder="" name="slug" id="slug" value="{{ old('slug') }}" required readonly>
                                        </div>
                                        @error('slug')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-md-6">
                                        <label class="form-label">Category</label>
                                        <select class="form-select" id="category_id" name="category_id" >
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach                                            
                                        </select>
                                        @error('category_id')
                                            <span style="color: red;">{{ $message }}</span>
                                        @enderror
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

                $('#title').on('keyup', function(e){
                    let nameval = $(this).val();
                    let slug = slugify(nameval);
                    $('#slug').val(slug);
                });

                $('#post-create').submit(function (e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    $('#submitbtn').text('Submitting...');
                    $.ajax({
                        type: "post",
                        url: "{{ route('post.new.create') }}",
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,                         
                        success: function (data) {
                            $('#submitbtn').text('Submit');                            
                            if(data.status == true){
                                toastr.success('Post created successfully!');
                                setTimeout(function () {
                                    window.location.href = "{{ url('/editnewpost/') }}"+"/"+data.post_id;                            
                                }, 2000);                                                      
                            }else{
                                toastr.error(data.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            $('#submitbtn').text('Submit');
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                if (xhr.responseJSON.errors.title) {
                                    $('#title').text(xhr.responseJSON.errors.title);
                                } else {
                                    $('#title').text(''); 
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