

<head>
    <title>Create Trainer</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

</head>

    <h1>Create Trainer</h1>
    <hr>

    <div class="form-group col-md-3">
        <label for="name">Name:</label>
        <input type="text" class="form-control " id="name" placeholder="Enter Name">
    </div>
    <div class="form-group col-md-3">
        <label for="contact">Contact:</label>
        <input type="text" class="form-control" id="contact" placeholder="Enter Contact">
    </div>
    <div class="form-group col-md-3">
        <label for="TrainerID">Trainer ID:</label>
        <input type="text" class="form-control" id="TrainerID" placeholder="Enter Trainer ID">
    </div>
    <div class="form-group col-md-3">
        <label for="age">Age:</label>
        <input type="age" class="form-control" id="age" placeholder="Enter Age">
    </div>

    <button type="button" class="btn btn-primary" id="insertTrainer" style="margin: 2rem">Submit</button>
    <button type="button" class="btn btn-primary" id="updateTrainer" style="margin: 2rem">Update</button>

    </div>



    <h1>Trainer Records</h1>
    <hr>
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <th scope="col">Name
                </th>
                <th scope="col">Contact
                </th>
                <th scope="col">TrainerID
                </th>
                <th scope="col">Created By
                </th>
                <th scope="col">Created On
                </th>
                <th scope="col">Actions
                </th>
            </thead>
            <tbody id='tbody'></tbody>
        </table>
    </div>




    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>

    <script>

        $(document).ready(function () {
            $("#updateTrainer").hide();

            showData();

            $('#insertTrainer').click(function () {

                var trainerID = $('#TrainerID').val();
                var age = $('#age').val();
                var name = $('#name').val();
                var contact = $('#contact').val();

                if (trainerID != '' && age != '' && name != '' && contact != '') {

                    $.ajax({
                        type: 'POST',
                        url: 'TrainerManageController/saveTrainer',
                        data: {
                            trainerID: trainerID,
                            age: age,
                            name: name,
                            contact: contact

                        },
                        success: function (response) {
                            toastr.success('Trainer Created succesfully');
                            showData();
                        }
                    });
                }
                else {
                    toastr.error('Enter All Fields');
                }
            })



            function showData() {
                var output = '';
                $.ajax({
                    url: 'TrainerManageController/retriveData',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        for (let i = 0; i < data.length; i++) {
                            output += "<tr><td>" + data[i].name + "</td><td>" + data[i].contact + "</td><td>" + data[i].trainer_id + "</td> <td>" + data[i].operator + "</td><td>" + data[i].date_time + "</td><td><button class='btn btn-danger' id='btndel' dataid=" + data[i].trainer_id + ">Delete</button> <button class='btn btn-warning' id='btnupdate' dataid=" + data[i].trainer_id + ">Update</button></td></tr>"
                        }
                        $('#tbody').html(output)
                    }
                })
            }




            $('#tbody').on("click", "#btndel", function () {

                var id = $(this).attr('dataid');
                let ref = this
                // alert (id);
                $.ajax({
                    url: 'TrainerManageController/deleteTrainer',
                    method: 'post',
                    data: {
                        postedData: id
                    },
                    success: function (response) {
                        let data = $.parseJSON(response);

                        if (data != 'success') {
                            toastr.error('Trainer Not Deleted');
                        }
                        toastr.success('Trainer Deleted succesfully');
                        $(ref).closest('tr').fadeOut(500);
                    }
                })
            })



            $('#tbody').on("click", "#btnupdate", function () {
                $("#updateTrainer").show();
                $("#insertTrainer").hide();
                var id = $(this).attr('dataid');
                var output = '';
                $.ajax({
                    url: 'TrainerManageController/showoldData',
                    method: 'POST',
                    data: {
                        postedData: id
                    },
                    success: function (res) {

                        let data = $.parseJSON(res);
                        

                        for (let j = 0; j < data.length; j++) {
                            $('#name').val(data[j].name);
                            $('#contact').val(data[j].contact);
                            $('#trainerID').val(data[j].trainer_id).attr('readonly', true);;
                            $('#age').val(data[j].age);
                        }
                    }
                })

            })
            $('#updateTrainer').click(function () {

                var trainerID = $('#trainerID').val();
                var age = $('#age').val();
                var name = $('#name').val();
                var contact = $('#contact').val();

                if (trainerID != '' && age != '' && name != '' && contact != '') {

                    $.ajax({
                        type: 'POST',
                        url: 'TrainerManageController/updatingTrainer',
                        data: {
                            trainerID: trainerID,
                            age: age,
                            name: name,
                            contact: contact

                        },
                        success: function (response) {
                            toastr.success('Trainer updated succesfully');
                            showData();
                        }
                    });
                }
                else {
                    toastr.error('Enter All Fields');
                }
            })
        })

    </script>
