<?php session_start() ?>
<div class="container-fluid">
	<form action="" id="signup-frm">
		<div class="form-group">
			<label for="" class="control-label">Name</label>
			<input type="text" name="name" required id="name" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Contact</label>
			<input type="text" name="contact" required id="contact" class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Address</label>
			<textarea cols="30" rows="3" name="address" required class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" name="email" required class="form-control">
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" required class="form-control">
		</div>
		<button class="button btn btn-info btn-sm">Create</button>
	</form>
</div>

<style>
	#uni_modal .modal-footer {
		display: none;
	}
</style>
<script>
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
<script>


	$('#signup-frm').submit(function (e) {
		e.preventDefault()
    	var NameRegex = /^[a-zA-Z\s]*$/;
		var ContactRegex =  /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
		const name = $("#name").val();
		const contact = $("#contact").val();
		console.log("name",name,typeof(name))
		console.log("contact",contact)
		if(!NameRegex.test(name)){
			console.log('not valid')
			$('#signup-frm').prepend(
						'<div class="alert alert-danger">Name is not valid</div>')

			return
		}else{
			console.log('name is valid')
		}
		if(!ContactRegex.test(contact)){
			$('#signup-frm').prepend(
						'<div class="alert alert-danger">Contact is not valid</div>')
			return

		}else{
			console.log('phone is valid')
		}
		$('#signup-frm button[type="submit"]').attr('disabled', true).html('Saving...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'admin/ajax.php?action=signup',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success: function (resp) {
				if (resp == 1) {
					location.reload();
				} else {
					$('#signup-frm').prepend(
						'<div class="alert alert-danger">Email already exist.</div>')
					$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');
				}
			}
		})
	})
</script>