<?php
include ('admin/db_connect.php')
?>
<style>
#uni_modal .modal-footer {
    display: none
}
</style>
<div class="container-fluid">
    <div class="col-lg-12">
        <div id="msg"></div>
        <form action="" id="manage-appointment">
            <input type="hidden" name="doctor_id" value="<?php echo $_GET['id'] ?>">
            <div class="form-group">
                <label for="" class="control-label">Date</label>
                <input type="date" min="<?= date('Y-m-d'); ?>" value="" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="" class="control-label">Time</label>
                <!-- <input type="time" min="10:00" max="17:00" value="" name="time" class="form-control" required> -->
                <select id="time" name="time" class="form-control" required>
                    <option value="10:00AM">10:00 AM</option>
                    <option value="10:30AM">10:30 AM</option>
                    <option value="11:00AM">11:00 AM</option>
                    <option value="11:30AM">11:30 AM</option>
                    <option value="12:00PM">12:00 PM</option>
                    <option value="12:30PM">12:30 PM</option>
                    <option value="01:00PM">01:00 PM</option>
                    <option value="01:30PM">01:30 PM</option>
                    <option value="02:00PM">02:00 PM</option>
                    <option value="02:30PM">02:30 PM</option>
                    <option value="03:00PM">03:00 PM</option>
                    <option value="03:30PM">03:30 PM</option>
                    <option value="04:00PM">04:00 PM</option>
                    <option value="04:30PM">04:30 PM</option>
                    <option value="05:00PM">05:00 PM</option>
                </select>
            </div>

            <hr>
            <div class="col-md-12 text-center">
                <button class="btn-primary btn btn-sm col-md-4">Request</button>
                <button class="btn btn-secondary btn-sm col-md-4  " type="button" data-dismiss="modal"
                    id="">Close</button>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function(){
    console.log('get_valid_times')
    this.id ='<?php echo $_GET['id'] ?>'
    console.log(this.id)
    $.ajax({
        url: 'admin/ajax.php?action=get_valid_times',
        method: 'POST',
        data: {
            docId:'<?php echo $_GET['id'] ?>'
        },
        success: function(resp) {
            resp = JSON.parse(resp)
            console.log(resp);
            if (resp.status == 1) {
                alert_toast("Request submitted successfully");
                end_load();
                $('.modal').modal("hide");
            } else {
                $('#msg').html('<div class="alert alert-danger">' + resp.msg + '</div>')
                end_load();
            }
        }
    })
})

$("#manage-appointment").submit(function(e) {
    const ogData = $(this).serialize();
    alert(ogData);
    return false;
    e.preventDefault()
    start_load()
    $.ajax({
        url: 'admin/ajax.php?action=set_appointment',
        method: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
            resp = JSON.parse(resp)
            if (resp.status == 1) {
                alert_toast("Request submitted successfully");
                end_load();
                $('.modal').modal("hide");
            } else {
                $('#msg').html('<div class="alert alert-danger">' + resp.msg + '</div>')
                end_load();
            }
        }
    })
})
</script>