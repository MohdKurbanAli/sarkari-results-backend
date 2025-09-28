@section('page_cssk')
    <!-- filepond css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/filepond/image-preview.min.css') }}">    
@endsection

@include('layouts.header')

<main>
    <div class="container-fluid">

        <!-- Student Details Form start -->
        <div class="col-12 mt-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3>POST:- {{ $post->title }} </h3>
                </div>
                <div class="card-body">
                    <form class="app-form" id="app-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">  
                                           
                            <div class="col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Author</label>
                                    <input type="text" id="author" name="author" class="form-control" value="admin">
                                    <span style="color: red;" id="authorError"></span>
                                </div>
                            </div>

                            <div class="file-uploader-box">
                                <div class="col-sm-12">
                                    <input class="filepond-1" type="file" id="post_image" name="job_image" multiple="multiple"
                                            data-allow-reorder="true">
                                    <span style="color: red;" id="post_imageError"></span>
                                </div>
                            </div>
                            <div>
                                <br>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $post->title }}"
                                            readonly>                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">URL</label>
                                    <input type="text" id="slug" name="slug" class="form-control" value="{{ url($post->category->slug."/".$post->slug) }}"
                                            readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control summernote" name="description" id="ckeditor1" cols="" rows="10">{{ old('description') ?? '' }}</textarea>                                    
                                    <span style="color: red;" id="descriptionError"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Organisation Name</label>
                                    <input type="text" id="organisation_name" name="organisation_name" class="form-control" value="{{ old('organisation_name') ?? '' }}">
                                    <span style="color: red;" id="organisation_nameError"></span>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Total Vacancies</label>
                                    <input type="number" id="total_vacancies" name="total_vacancies" class="form-control" value="{{ old('total_vacancies') ?? '' }}">
                                    <span style="color: red;" id="total_vacanciesError"></span>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Application Apply Mode</label>
                                    <select class="form-select" id="application_mode" name="application_mode">                                        
                                        <option value="0">Online</option>
                                        <option value="1">Offline</option>
                                        <option value="2">Online & Offline Both</option>
                                    </select>
                                    <span style="color: red;" id="application_modeError"></span>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Job Location</label>
                                    <input type="text" id="job_location" name="job_location" class="form-control" value="{{ old('job_location') ?? '' }}">
                                    <span style="color: red;" id="job_locationError"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Important Dates</label>
                                    <textarea class="form-control summernote" name="important_dates" id="important_dates" cols="" rows="8">{{ old('important_dates') ?? '' }}</textarea>                                    
                                    <span style="color: red;" id="important_datesError"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Application Fees Points</label>
                                    <textarea class="form-control summernote" name="application_fee_points" id="application_fee_points" cols="" rows="8">{{ old('application_fee_points') ?? '' }}</textarea>                                    
                                    <span style="color: red;" id="application_fee_pointsError"></span>
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Age Header</label>
                                    <input type="text" id="age_header" name="age_header" class="form-control" value="{{ old('age_header') ?? '' }}">
                                    <span style="color: red;" id="age_headerError"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Age Points</label>
                                    <textarea class="form-control summernote" name="age_points" id="age_points" cols="" rows="8">{{ old('age_points') ?? '' }}</textarea>                                    
                                    <span style="color: red;" id="age_pointsError"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Job Post Details</label>
                                    <textarea class="form-control summernote" name="job_post_datails" id="job_post_datails" cols="" rows="15">{{ old('job_post_datails') ?? '' }}</textarea>                                    
                                    <span style="color: red;" id="job_post_datailsError"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Job Post Usefull Links</label>
                                    <textarea class="form-control summernote" name="job_post_useful_links" id="job_post_useful_links" cols="" rows="15">{{ old('job_post_useful_links') ?? '' }}</textarea>                                    
                                    <span style="color: red;" id="job_post_useful_linksError"></span>
                                </div>
                            </div>
                            <div class="">
                                <hr>
                            </div>

                            <div id="faq-container">
                                <div class="faq-item">
                                    <div class="col-md-6 col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-label">Question</label>
                                        <input type="text" id="faq[][question]" name="faq[][question]" class="form-control">
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Answer</label>
                                        <textarea class="form-control summernote-tiny" name="faq[][answer]" id="faq[][answer]" cols="" rows="2"></textarea>
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                                    </div>
                                    <br>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" id="add-question-btn">Add Question</button>
                            </div>


                            <div class="">
                                <hr>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Meta Title <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control"
                                            placeholder="Meta Title" name="meta_title" id="meta_title" value="{{ $post->meta_title ?? old('meta_title') }}" >
                                </div>
                            </div>   
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Meta Description <span style="color: red;">*</span></label>
                                    <textarea name="meta_description" id="meta_description" rows="2" class="form-control" type="text">{{ $post->meta_description ?? old('meta_description') }}</textarea>                                            
                                </div>
                            </div>  

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Meta Keywords <span style="color: red;">*</span></label>
                                    <textarea name="meta_keywords" id="meta_keywords" rows="2" class="form-control" type="text">{{ $post->meta_keywords ?? old('meta_keywords') }}</textarea>                                            
                                </div>
                            </div>  

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Page Header Scripts <span style="color: red;">*</span></label>
                                    <textarea name="page_header_script" id="page_header_script" rows="3" class="form-control" type="text">{{ $post->page_header_script ?? old('page_header_script') }}</textarea>                                            
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Page Footer Scripts <span style="color: red;">*</span></label>
                                    <textarea name="page_footer_script" id="page_footer_script" rows="3" class="form-control" type="text">{{ $post->page_footer_script ?? old('page_footer_script') }}</textarea>                                            
                                </div>
                            </div>

                            <div class="col-md-6 col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Post Publish Status</label>
                                    <select class="form-select" id="is_active" name="is_active">                                        
                                        <option value="0">Not Published</option>
                                        <option value="1">Drafted</option>
                                        <option value="2">Published</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="col-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary" id="submitbtn">Save</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Student Details Form end -->

    </div>
</main>

@section('page_jsk')
    <!-- js -->    
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js"></script>

    <script>
        
        FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateSize, FilePondPluginFileValidateType);
        const pond = FilePond.create(document.querySelector("#post_image"), {
            allowMultiple: true,
            maxFiles: 5, // Maximum number of files
            maxFileSize: '3MB',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
        });


        document.getElementById('add-question-btn').addEventListener('click', function() {
            const faqContainer = document.getElementById('faq-container');
            const newFaqItem = faqContainer.querySelector('.faq-item').cloneNode(true);
            newFaqItem.querySelector('input').value = '';
            newFaqItem.querySelector('textarea').value = '';
            faqContainer.appendChild(newFaqItem);            
            const deleteButton = newFaqItem.querySelector('.delete-btn');
            deleteButton.addEventListener('click', function() {
            faqContainer.removeChild(newFaqItem);
            });
        });
        
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
            const faqItem = button.closest('.faq-item');
            faqItem.parentNode.removeChild(faqItem);
            });
        });  
        
        
        $(document).ready(function () {

            $('#app-form').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $('#submitbtn').text('Saving...');
                $.ajax({
                    type: "post",
                    url: "{{ route('post.new.savenew', ['post'=>$post]) }}",
                    data: formData,                    
                    contentType: false,
                    processData: false,                         
                    success: function (data) {

                        $('#submitbtn').text('Save');                            
                        if(data.status == true){
                            toastr.success(data.message);
                            setTimeout(function () {
                                window.location.href = "{{ route('category.index') }}";                            
                            }, 2000);                                                      
                        }else{
                            toastr.error(data.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        $('#submitbtn').text('Save');
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            if (xhr.responseJSON.errors.job_image) {
                                $('#job_imageError').text(xhr.responseJSON.errors.job_image);
                            } else {
                                $('#job_imageError').text(''); 
                            }

                            if (xhr.responseJSON.errors.description) {
                                $('#descriptionError').text(xhr.responseJSON.errors.description);
                            } else {
                                $('#descriptionError').text(''); 
                            }

                            if (xhr.responseJSON.errors.organisation_name) {
                                $('#organisation_nameError').text(xhr.responseJSON.errors.organisation_name);
                            } else {
                                $('#organisation_nameError').text(''); 
                            }

                            if (xhr.responseJSON.errors.total_vacancies) {
                                $('#total_vacanciesError').text(xhr.responseJSON.errors.total_vacancies);
                            } else {
                                $('#total_vacanciesError').text(''); 
                            }

                            if (xhr.responseJSON.errors.application_mode) {
                                $('#application_modeError').text(xhr.responseJSON.errors.application_mode);
                            } else {
                                $('#application_modeError').text(''); 
                            }

                            if (xhr.responseJSON.errors.job_location) {
                                $('#job_locationError').text(xhr.responseJSON.errors.job_location);
                            } else {
                                $('#job_locationError').text(''); 
                            }

                            if (xhr.responseJSON.errors.important_dates) {
                                $('#important_datesError').text(xhr.responseJSON.errors.important_dates);
                            } else {
                                $('#important_datesError').text(''); 
                            }

                            if (xhr.responseJSON.errors.application_fee_points) {
                                $('#application_fee_pointsError').text(xhr.responseJSON.errors.application_fee_points);
                            } else {
                                $('#application_fee_pointsError').text(''); 
                            }

                            if (xhr.responseJSON.errors.age_header) {
                                $('#age_headerError').text(xhr.responseJSON.errors.age_header);
                            } else {
                                $('#age_headerError').text(''); 
                            }

                            if (xhr.responseJSON.errors.age_points) {
                                $('#age_pointsError').text(xhr.responseJSON.errors.age_points);
                            } else {
                                $('#age_pointsError').text(''); 
                            }

                            if (xhr.responseJSON.errors.job_post_datails) {
                                $('#job_post_datailsError').text(xhr.responseJSON.errors.job_post_datails);
                            } else {
                                $('#job_post_datailsError').text(''); 
                            }

                            if (xhr.responseJSON.errors.job_post_useful_links) {
                                $('#job_post_useful_linksError').text(xhr.responseJSON.errors.job_post_useful_links);
                            } else {
                                $('#job_post_useful_linksError').text(''); 
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