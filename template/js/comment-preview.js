$(function(){
	
	//getting preview of a comment
	$('#show-preview').on('click', function(){
		
		var text = $('#comment-text').val();
		var email = $('#comment-email').val();
		var name = $('#comment-name').val();
		
		//send comment to validation
		$.ajax({
			type:"POST",
			dataType: "json",
			url: "/comments/validatePreview",
            data: {'text':text,'email':email,'name':name},
            success: function(data){

				if (data.validated == 1){
					var imageInput = document.getElementById("comment-image");
					var imageUrl;
					if (imageInput.files && imageInput.files[0]){
						var reader = new FileReader();
			            
			            reader.onload = function (e) {
			            	$('#preview-no-image').hide();
			            	$('#preview-image').show();
			                $('#preview-image').attr('src', e.target.result);
			            };
			            
			            reader.readAsDataURL(imageInput.files[0]);
					}
					else{
						$('#preview-image').hide();
						$('#preview-no-image').show();
					}
					//creating preview
					$('#preview-text').html(text);
	                $('#preview-title').html("Published by "+name+" at "+ Date());
	                $('#preview-email').html("Author's e-mail: "+email);
	                $('#preview').modal('show'); 
	                $('.errors').empty();
				}
				else{
					var errors = data.errors;
					var errorList = "";
					for (var i = 0; i < errors.length; i++){
						errorList += "<li> - "+errors[i]+"</li>";
					}
					$('.errors').html(errorList);
				}
            },
            error: function(e){
            	console.log(e.responseText);
            }
		});	
		
		return false;
	});
});