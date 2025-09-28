@section('page_cssk')
    <!-- filepond css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/filepond/image-preview.min.css') }}">    
@endsection

@include('layouts.header')

    <main>
        <div class="container-fluid">
            
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit About Website</h5>
                        </div>
                        <div class="card-body">
                            <form class="app-form" id="about-save" method="POST">
                                @csrf
                                <div class="row">                                    

                                    <div class="col-md-6"> 
                                        <label for="favicon">Logo</label>                                       
                                        <div class="file-uploader-box">                                        
                                            <input class="filepond-1" type="file" id="logo" name="logo"
                                                    data-allow-reorder="true">
                                            <span style="color: red;" id="logoError"></span>                                        
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="favicon">Favicon</label>
                                        <div class="file-uploader-box">                                        
                                            <input class="filepond-1" type="file" id="favicon" name="favicon"
                                                    data-allow-reorder="true">
                                            <span style="color: red;" id="faviconError"></span>                                        
                                        </div>
                                    </div>

                                    <div>
                                        <br>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Site Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control"
                                                    placeholder="Enter Site Name" name="site_name" id="site_name" value="{{ $about->site_name ?? old('site_name') }}" required>
                                        </div>
                                    </div>                                    

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control"
                                                    placeholder="" name="email" id="email" value="{{ $about->email ?? old('email') }}">
                                        </div>
                                    </div>                                    

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Number </label>
                                            <input type="text" class="form-control"
                                                    placeholder="" name="number" id="number	" value="{{ $about->number ?? old('number') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Address </label>
                                            <input type="text" class="form-control"
                                                    placeholder="" name="address" id="address" value="{{ $about->address ?? old('address') }}">
                                        </div>
                                    </div>                                    
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Title <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control"
                                                    placeholder="Meta Title" name="meta_title" id="meta_title" value="{{ $about->meta_title ?? old('meta_title') }}" >
                                        </div>
                                    </div>   
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description <span style="color: red;">*</span></label>
                                            <textarea name="meta_description" id="meta_description" rows="2" class="form-control" type="text">{{ $about->meta_description ?? old('meta_description') }}</textarea>                                            
                                        </div>
                                    </div>  

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Meta Keywords <span style="color: red;">*</span></label>
                                            <textarea name="meta_keywords" id="meta_keywords" rows="2" class="form-control" type="text">{{ $about->meta_keywords ?? old('meta_keywords') }}</textarea>                                            
                                        </div>
                                    </div>  

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Page Header Scripts <span style="color: red;">*</span></label>
                                            <textarea name="page_header_script" id="page_header_script" rows="3" class="form-control" type="text">{{ $about->page_header_script ?? old('page_header_script') }}</textarea>                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Page Footer Scripts <span style="color: red;">*</span></label>
                                            <textarea name="page_footer_script" id="page_footer_script" rows="3" class="form-control" type="text">{{ $about->page_footer_script ?? old('page_footer_script') }}</textarea>                                            
                                        </div>
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

        <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
        <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>

        <script>

            FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateSize, FilePondPluginFileValidateType);
            const pond = FilePond.create(document.querySelector("#logo"), {
                allowMultiple: false,                
                maxFileSize: '10MB',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/avif'],
            });

            const filePath = "{{ $about->logo ?? '' }}";                
            if (filePath) {
                const correctFilePath = window.location.origin + '/' + filePath;

                fetch(correctFilePath) 
                    .then(response => response.blob()) 
                    .then(blob => {
                        const fileName = correctFilePath.split('/').pop(); 
                        const file = new File([blob], fileName, {
                            type: blob.type
                        });

                        pond.addFile(file); 
                    })
                    .catch(error => console.error("Error loading file:", error));
            }            

            FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateSize, FilePondPluginFileValidateType);
            const pond1 = FilePond.create(document.querySelector("#favicon"), {
                allowMultiple: false,                
                maxFileSize: '10MB',
                acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp', 'image/avif'],
            });

            $(document).ready(function () {

                $('#about-save').submit(function (e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    $('#submitbtn').text('Submitting...');
                    $.ajax({
                        type: "post",
                        url: "{{ route('about.save') }}",
                        data: formData,                        
                        contentType: false,
                        processData: false,                         
                        success: function (data) {
                            console.log(data);
                            $('#submitbtn').text('Submit');                            
                            if(data == true){
                                toastr.success(data.message);
                                setTimeout(function () {
                                    window.location.href = "{{ route('about.index') }}";                            
                                }, 2000);                                                      
                            }else{
                                toastr.error(data.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            $('#submitbtn').text('Submit');
                            
                        }
                    });
                });
            });
        </script>
    @endsection
@include('layouts.footer')