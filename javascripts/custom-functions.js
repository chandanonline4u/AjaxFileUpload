/**
 * JS Functions.
 */
var emailfilter = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
var scrollOffset = -100;
var files;
var uploadFieldTarget = '';

(function($){
  
  function scrollToElement(selector, time, verticalOffset, callback) {
    time = typeof(time) != 'undefined' ? time : 500;
    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
    element = $(selector);
    offset = element.offset();
    offsetTop = offset.top + verticalOffset;
    t = ($(window).scrollTop() - offsetTop);
    if (t <= 0) t *= -1
    t = parseInt(t * .5);
    if (t < time) t=time
    if (t > 1500) t=1500
    $('html, body').animate({
      scrollTop: offsetTop
    }, t, 'easeInOutCirc', callback);
  } 
  
  // pre-submit callback 
  function showUploadRequest(formData, jqForm, options) { 
    var isValid = true;
    var err_msg = "";
    var $alert = $('.alert', jqForm);
    $alert.addClass('hidden');
    $('.has-error', jqForm).removeClass('has-error');

    /* Global validation check for required fields and email */
    $('.required', jqForm).each(function() {
      if($(this).val().replace(/^\s*|\s*$/g,"")=="") {
        $(this).addClass('has-error');
        isValid=false;
      }
    });
    
    if(isValid){
      jqForm.addClass('show-loading');
    }
    return isValid;
  } 

  // post-submit callback 
  function showUploadResponse(responseText, statusText, xhr, $form)  { 
    //Hide Show Loading
    if($form.hasClass('show-loading')){
      $form.removeClass('show-loading');
    }
    var $formWrapper = $form.parents('.form-wrapper');
    var result = $.parseJSON(responseText);

    if (statusText===" success" || statusText==="success"){
      if (result.success == 1){
        // $form[0].reset();
        $form.hide();
        if($('.alert', $formWrapper).length > 0){
          $('.alert', $formWrapper).html(result.message).show();
          $('.alert', $formWrapper).addClass('success').reomveClass('error');
        }
      } else {
        if($('.alert', $formWrapper).length > 0){
          $('.alert', $formWrapper).html(result.message).show();
          $('.alert', $formWrapper).addClass('error').reomveClass('success');
        }
      }
    } else {
      alert('Error while uploading your file.');
    }
  } 
  
  
  ( function() {
    
    //Ajax Form Submission
    if($('.form-upload').length > 0) {
      $('.form-upload').each(function() {
        var $formUpload = $(this);
        var uploadOptions = {
          beforeSubmit:  showUploadRequest, 
          success: showUploadResponse
        };
        
        $formUpload.submit(function() {
          $(this).ajaxSubmit(uploadOptions);
          return false;
        });
      });
    }

  } )();
 
})(jQuery);
