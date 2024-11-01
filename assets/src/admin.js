//jquery-ui-tabs
(function($) {
    // After the document is ready
	$("#simple-product-fields").on('click',function (e) {
    e.preventDefault(); // Stop the browser from following the link
    let formValues=$("#simple-product-shipping").serializeArray();
    //convert serializeArray to object
    let formValuesObj={};
    formValues.forEach(function(field){
        formValuesObj[field.name]=field.value;
    });
    //get nonce 
    let nonce = formValuesObj.nonce;
    
    jQuery.ajax({
      type: "post",
      dataType: "json",
      url: myAjax.ajaxurl,
      data: {
        action: "checkout_field_manager",
        formValues: formValuesObj,
        nonce: nonce,
      },
      success: function (response) {
        if (response.success) {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer:2000,
          });
        } else {
          alert("Your vote could not be added");
        }
      },
    });
  });

})(jQuery);