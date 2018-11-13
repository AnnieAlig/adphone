$('.submit').click(function(event){
    event.preventDefault();
    var form = $(this).parent();
    
    var name = form.find('.name').val();
    var email = form.find('.email').val();

    var error = false;

    var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,6}$/i;
        if(!email ||
            email.indexOf('.') <= 0 ||
            email.indexOf(' ') >= 0 ||
           !pattern.test(email)
       ){
        form.find('.email').addClass('error');
        var error_email =  form.find('.email + .label').attr('data-error');        
        form.find('.email + .label').text(error_email);
        error = true;
       } else{
        var email_text = form.find('.email + .label').attr('data-text');
        form.find('.email').removeClass('error');
        form.find('.email + .label').text(email_text);
       } 
       
       if (name == ""){
        form.find('.name').addClass('error');
        var error_name =  form.find('.name + .label').attr('data-error');        
        form.find('.name + .label').text(error_name);
        error = true;
        } else{
            var name_text = form.find('.name + .label').attr('data-text');
            form.find('.name').removeClass('error');
            form.find('.name + .label').text(name_text);
        }
        if (error != true){
            form.find('.name').removeClass('error');
            form.find('.email').removeClass('error');

        var params = {
            name: name,
            email: email
        }
        $.post('send.php', params, function(data){
          console.log(data);
        });

        $('.thank-you').fadeIn("slow").delay(2000).fadeOut("slow");
        form.trigger('reset');
    }    

});

$('.tab-link').click(function(e){
    e.preventDefault;
    $('.tab-link').removeClass('btn-primary');
    $(this).addClass('btn-primary');

    $('.tab').fadeOut('fast');
    var target = $(this).attr('href');
    $("[data-tab='" + target + "']").fadeIn('fast'); 

    return false;
})