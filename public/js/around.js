

$(function() {
    $('.datepicker').datepicker();

    $('[data-toggle="tooltip"]').tooltip();

    $(".select2-multiple").select2();
    $(".js-example-placeholder-single").select2({
        placeholder: "Select a state",
        allowClear: true
    });

});

window.resetFile = function (e) {
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
};

function makeSerializable(elem) {
    return $(elem).prop('elements', $('*', elem).andSelf().get());
}





function showError(error) {
    var error_msg = null;
    switch(error.code) {
        case error.PERMISSION_DENIED:
            error_msg = "You denied the request for Geolocation.";
            break;
        case error.POSITION_UNAVAILABLE:
            error_msg = "Location information is unavailable.";
            break;
        case error.TIMEOUT:
            error_msg = "The request to get user location timed out.";
            break;
        case error.UNKNOWN_ERROR:
            error_msg = "An unknown error occurred.";
            break;
    }
    $('#errorMessageModal').modal('show');
    $('#errorMessageModal #errors').html(error_msg);
    location_finder = "not-found";
}







function follow(following, follower, element, size){

    var data = new FormData();
    data.append('following', following);
    data.append('follower', follower);
    data.append('element', element);
    data.append('size', size);


    $.ajax({
        url: BASE_URL + '/follow',
        type: "POST",
        timeout: 5000,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        headers: {'X-CSRF-TOKEN': CSRF},
        success: function (response) {
            if (response.code == 200) {
                $(element).html(response.button);
                if (response.refresh == 1 && size != '.btn-no-refresh'){
                    location.reload();
                }
            } else {
                $('#errorMessageModal').modal('show');
                $('#errorMessageModal #errors').html('Something went wrong!');
            }
        },
        error: function () {
            $('#errorMessageModal').modal('show');
            $('#errorMessageModal #errors').html('Something went wrong!');
        }
    });

}

function followRequest(type, id){

    var data = new FormData();
    data.append('type', type);
    data.append('id', id);

    $.ajax({
        url: BASE_URL + '/follower/request',
        type: "POST",
        timeout: 5000,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        headers: {'X-CSRF-TOKEN': CSRF},
        success: function (response) {
            if (response.code == 200) {
                $('#approve-buttons-'+id+' .btn').remove();
                if (type == 1){
                    $('#approve-buttons-'+id+' .approved').show();
                }else{
                    $('#approve-buttons-'+id+' .denied').show();
                }
            } else {
                $('#errorMessageModal').modal('show');
                $('#errorMessageModal #errors').html('Something went wrong!');
            }
        },
        error: function () {
            $('#errorMessageModal').modal('show');
            $('#errorMessageModal #errors').html('Something went wrong!');
        }
    });

}

function deniedFollow(me, follower, element, size){

    var data = new FormData();
    data.append('me', me);
    data.append('follower', follower);
    data.append('element', element);
    data.append('size', size);


    $.ajax({
        url: BASE_URL + '/follower/denied',
        type: "POST",
        timeout: 5000,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        headers: {'X-CSRF-TOKEN': CSRF},
        success: function (response) {
            if (response.code == 200) {
                location.reload();
            } else {
                $('#errorMessageModal').modal('show');
                $('#errorMessageModal #errors').html('Something went wrong!');
            }
        },
        error: function () {
            $('#errorMessageModal').modal('show');
            $('#errorMessageModal #errors').html('Something went wrong!');
        }
    });

}


function relativeRequest(type, id){

    var data = new FormData();
    data.append('type', type);
    data.append('id', id);

    $.ajax({
        url: BASE_URL + '/relative/request',
        type: "POST",
        timeout: 5000,
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        headers: {'X-CSRF-TOKEN': CSRF},
        success: function (response) {
            if (response.code == 200) {
                $('#approve-buttons-'+id+' .btn').remove();
                if (type == 1){
                    $('#approve-buttons-'+id+' .approved').show();
                }else{
                    $('#approve-buttons-'+id+' .denied').show();
                }
            } else {
                $('#errorMessageModal').modal('show');
                $('#errorMessageModal #errors').html('Something went wrong!');
            }
        },
        error: function () {
            $('#errorMessageModal').modal('show');
            $('#errorMessageModal #errors').html('Something went wrong!');
        }
    });

}

function removeRelation(type, id){

    BootstrapDialog.show({
        title: 'Borrar Relacion!',
        message: 'Estas seguro ?',
        buttons: [{
            label: "Si, lo estoy!",
            cssClass: 'btn-danger',
            action: function(dialog) {

                var data = new FormData();
                data.append('type', type);
                data.append('id', id);


                $.ajax({
                    url: BASE_URL + '/relative/delete',
                    type: "POST",
                    timeout: 5000,
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    headers: {'X-CSRF-TOKEN': CSRF},
                    success: function(response){
                        dialog.close();
                        if (response.code == 200){
                            location.reload();
                        }else{
                            $('#errorMessageModal').modal('show');
                            $('#errorMessageModal #errors').html('Algo salio Mal!');
                        }
                    },
                    error: function(){
                        dialog.close();
                        $('#errorMessageModal').modal('show');
                        $('#errorMessageModal #errors').html('Algo salio Mal!');
                    }
                });
            }
        }, {
            label: 'No!',
            action: function(dialog) {
                dialog.close();
            }
        }]
    });
}

  var color;
  function changeBackground () {
    var r = parseInt(document.getElementById('red').value, 10);
        g = parseInt(document.getElementById('green').value, 10),
        b = parseInt(document.getElementById('blue').value, 10);
    return  color = document.getElementById('app').style.backgroundColor = 'rgb('+r+', '+g+', '+b+')';
  }
