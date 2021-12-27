function sendPostRequest({path, data, done = function(data){console.log(data);}, fail = function(xhr){console.log(xhr);}} = {}){

    const baseUrl = window.location.origin;
    const url = baseUrl + "/" + path;

    $.ajax({
        type : 'POST',
        url : url,
        data : data,
    }).done(done).fail(fail);
}

$(document).ready(function(){

    $("#login_form").submit(function(e){
        e.preventDefault();

        const formData = $(this).serializeArray();

        const path = "authenticate";
        sendPostRequest({
            path : path,
            data : formData,
            done : function(data){
                console.log(data);
                if(data['data'] == null){
                    document.getElementById('validation_msg').innerHTML = data['message'];
                    $("#login_form").reset();
                }else{
                    window.location.reload();
                }
                
                
            },
        });

    });
});