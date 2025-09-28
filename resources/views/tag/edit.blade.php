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
                            <form class="app-form" id="tag-edit" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tag Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control"
                                                    placeholder="Enter tag Name" name="name" id="name" value="{{ $tag->name ?? old('name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-md-6">
                                        <label class="form-label">Active Status</label>
                                        <select class="form-select" id="status" name="is_active" >
                                            <option value="1" {{ $tag->is_active == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $tag->is_active == 0 ? 'selected' : '' }}>Inactive</option>                                            
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

                $('#tag-edit').submit(function (e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    $('#submitbtn').text('Submitting...');
                    $.ajax({
                        type: "post",
                        url: "{{ route('tag.update', ['tag'=>$tag]) }}",
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,                         
                        success: function (data) {
                            $('#submitbtn').text('Submit');                            
                            if(data == 1){
                                toastr.success('Tag updated successfully!');
                                setTimeout(function () {
                                    window.location.href = "{{ route('tag.index') }}";                            
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