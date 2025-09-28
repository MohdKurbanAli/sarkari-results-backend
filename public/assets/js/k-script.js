function slugify(name) {
  return name
    .toLowerCase()
    .trim()
    .replace(/[^a-z0-9\s-]/g, '')   
    .replace(/\s+/g, '-')           
    .replace(/-+/g, '-');           
}

function deleteById(id, routeUrl, csrf_token){

  $.ajax({
      type: "delete",
      url: routeUrl,
      data: {
        _token: csrf_token,
        id: id
      },
      success: function (data) {
          $('#submitbtn').text('Submit');                            
          if(data.status == true){
              toastr.success(data.message);
              setTimeout(function () {
                  window.location.href = data.redirect_url;                            
              }, 2000);                                                      
          }else{
              toastr.error(data.message);
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

}


