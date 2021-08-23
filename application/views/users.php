<div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3" id="toastPlacement" style="z-index: 1;">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header">
            <strong class="me-auto">Some Error Occured</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Please retry or reload the page
        </div>
    </div>
</div> 
<div class="container-fluid">
    <div class="row justify-content-center mt-3">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <form id="user-form">
                <div class="form-control-comp">
                    <h3 class="text-center">Form Component</h3>
                    <div class="spinner-api d-flex justify-content-center mt-3">
                        <div class="spinner-grow text-dark" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="submit-btn d-none d-flex justify-content-center">
                    <button type="submit" class="btn btn-info mt-5 mb-5">Submit</button>
                </div>
                <div class="alert d-none alert-success mt-5 mb-5" role="alert">
                    Form Submitted Sucessfully
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">

    var data_length = 0;

    // Reload Button Toast
    $( "#reload-button" ).click(function() {
        location.reload();
    });

    // AJAX Call for API GET
    $.get('https://jsonplaceholder.typicode.com/users', function (data) {

        $('.submit-btn').removeClass('d-none');
        $('.spinner-api').addClass('d-none');

        var data_length = data.length;

        for(i=0; i<data.length; i++){
            var form_user = `<div class="mt-5" style="background-color: #def9ff; padding: 1.5em; border-radius: 10px; box-shadow: 2px 2px 6px 0px #a1a1a1">
                                <div class="fw-bolder text-center">User ${data[i].id}</div>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name-txt" value="${data[i].name}" disabled>
                                <input type="hidden" class="form-control" id="userId-${data[i].id}" value="${data[i].id}">
                                <label for="title-${data[i].id}" class="form-label">Enter Title</label>
                                <input type="text" class="form-control" id="title-${data[i].id}" required>
                                <label for="body-${data[i].id}" class="form-label">Enter Body</label>
                                <textarea class="form-control" id="body-${data[i].id}" rows="2" required></textarea>
                            </div>`;
            $('.form-control-comp').append(form_user);
        }  

        // Submit Form Handle
        $( "#user-form" ).submit(function(e) {
        event.preventDefault();
        var fd = []
        for(i=0; i<data.length; i++){

            // Form Submit API Call
            $.post(
                'https://jsonplaceholder.typicode.com/posts', 
                {
                    userId: $("#userId-"+data[i].id).val(),
                    title: $("#title-"+data[i].id).val(),
                    body: $("#body-"+data[i].id).val()
                }, 
                function(data){
                    $('.submit-btn').addClass('d-none')
                    $('.alert').removeClass('d-none')
            })
            // Error function
            .fail(function() {
                $('.toast').toast('show');
            });
        };

    });
    })
    // Error function
    .fail(function() {
        $('.toast').toast('show');

    });
</script>
