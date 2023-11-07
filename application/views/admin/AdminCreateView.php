

<head>
    <title>Create Admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

</head>

    <h1>Create Admin</h1>
    <hr>
    <div class="col-md-12">
   <div class="well     ">

   
    <div class="form-group col-md-3">
        <label for="name">Name:</label>
        <input type="text" class="form-control " id="name" placeholder="Enter Name">
    </div>
    <div class="form-group col-md-3">
        <label for="contact">Contact:</label>
        <input type="text" class="form-control" id="contact" placeholder="Enter Contact">
    </div>
    <div class="form-group col-md-3">
        <label for="AdminID">Admin ID:</label>
        <input type="text" class="form-control" id="adminID" placeholder="Enter Admin ID">
    </div>
    <div class="form-group col-md-3">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" placeholder="Enter Password">
    </div>
  
    <button type="button" class="btn btn-primary" id="insertAdmin" style="margin: 2rem">Submit</button>
    <button type="button" class="btn btn-primary" id="updateAdmin" style="margin: 2rem">Update</button>
    </div>
    </div>

    </div>

    <h1>Admin Records</h1>
    <hr>
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <th scope="col">Name
                </th>
                <th scope="col">Contact
                </th>
                <th scope="col">AdminID
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
            $("#updateAdmin").hide();

            showData();

            $('#insertAdmin').click(function () {

                var adminID = $('#adminID').val();
                var password = $('#password').val();
                var name = $('#name').val();
                var contact = $('#contact').val();

                if (adminID != '' && password != '' && name != '' && contact != '') {

                    $.ajax({
                        type: 'POST',
                        url: 'AdminManageController/saveAdmin',
                        data: {
                            adminID: adminID,
                            password: password,
                            name: name,
                            contact: contact
                        },
                        success: function (response) {
                            toastr.success('Admin Created succesfully');
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
                    url: 'AdminManageController/retriveData',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        for (let i = 0; i < data.length; i++) {
                            output += "<tr><td>" + data[i].name + "</td><td>" + data[i].contact + "</td><td>" + data[i].admin_id + "</td> <td>" + data[i].operator + "</td><td>" + data[i].date_time + "</td><td><button class='btn btn-danger' id='btndel' dataid=" + data[i].admin_id + ">Delete</button> <button class='btn btn-warning' id='btnupdate' dataid=" + data[i].admin_id + ">Update</button></td></tr>"
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
                    url: 'AdminManageController/deleteAdmin',
                    method: 'post',
                    data: {
                        postedData: id
                    },
                    success: function (response) {
                        let data = $.parseJSON(response);

                        if (data != 'success') {
                            toastr.error('Admin Not Deleted');
                        }
                        toastr.success('Admin Deleted succesfully');
                        $(ref).closest('tr').fadeOut(500);
                    }
                })
            })



            $('#tbody').on("click", "#btnupdate", function () {
                $("#updateAdmin").show();
                $("#insertAdmin").hide();
                var id = $(this).attr('dataid');
                var output = '';
                $.ajax({
                    url: 'AdminManageController/showoldData',
                    method: 'POST',
                    data: {
                        postedData: id
                    },
                    success: function (res) {

                        let data = $.parseJSON(res);
                        

                        for (let j = 0; j < data.length; j++) {
                            $('#name').val(data[j].name);
                            $('#contact').val(data[j].contact);
                            $('#adminID').val(data[j].admin_id).attr('readonly', true);;
                            $('#password').val(data[j].password);
                        }
                    }
                })

            })
            $('#updateAdmin').click(function () {

                var adminID = $('#adminID').val();
                var password = $('#password').val();
                var name = $('#name').val();
                var contact = $('#contact').val();

                if (adminID != '' && password != '' && name != '' && contact != '') {

                    $.ajax({
                        type: 'POST',
                        url: 'AdminManageController/updatingAdmin',
                        data: {
                            adminID: adminID,
                            password: password,
                            name: name,
                            contact: contact

                        },
                        success: function (response) {
                            toastr.success('Admin updated succesfully');
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
