<head>
    <title>Create Member</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

</head>
<h1>Create Member</h1>
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
    <label for="address">Address:</label>
    <input type="text" class="form-control" id="address" placeholder="Enter Address">
</div>
<div class="form-group col-md-3">
    <label for="age">Age:</label>
    <input type="text" class="form-control" id="age" placeholder="Enter Age">
</div>
<div class="form-group col-md-3">
    <label for="city">City:</label>
    <input type="text" class="form-control" id="city" placeholder="Enter City">
</div>
<div class="form-group col-md-3">
    <label for="memberID">Member ID:</label>
    <input type="text" class="form-control" id="memberID" placeholder="Enter member ID">
</div>
<div class="form-group col-md-3">
    <label for="package">Choose a Package:</label>
    <select class="form-control" id="package">
        <option value="Gym only">Gym only</option>
        <option value="Gym with cardio">Gym with cardio</option>
    </select>
</div>


<button type="button" class="btn btn-primary" id="insertMember" style="margin: 2rem">Submit</button>
<button type="button" class="btn btn-primary" id="updateMember" style="margin: 2rem">Update</button>

</div>



<h1>Member Records</h1>
<hr>
<div class="col-md-12">
    <table class="table table-bordered">
        <thead>
            <th scope="col">Name
            </th>
            <th scope="col">Contact
            </th>
            <th scope="col">Address
            </th>
            <th scope="col">Age
            </th>
            <th scope="col">City
            </th>
            <th scope="col">MemberID
            </th>
            <th scope="col">Package
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




<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>

<script>

    $(document).ready(function () {
        $("#updateMember").hide();

        showData();

        $('#insertMember').click(function () {

            var name = $('#name').val();
            var contact = $('#contact').val();
            var address = $('#address').val();
            var age = $('#age').val();
            var city = $('#city').val();
            var memberID = $('#memberID').val();
            var package = $('#package').val();


            if (memberID != '' && package != '' && name != '' && contact != '' && address != '' && age != '' && city != '') {

                $.ajax({
                    type: 'POST',
                    url: 'MemberManageController/saveMember',
                    data: {
                        memberID: memberID,
                        package: package,
                        name: name,
                        contact: contact,
                        address: address,
                        age: age,
                        city: city
                    },
                    success: function (response) {
                        toastr.success('Member Created succesfully');
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
                url: 'MemberManageController/retriveData',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    for (let i = 0; i < data.length; i++) {
                        output += "<tr><td>" + data[i].name + "</td><td>" + data[i].contact + "</td><td>" + data[i].address + "</td><td>" + data[i].age + "</td><td>" + data[i].city + "</td><td>" + data[i].member_id + "</td><td>" + data[i].package + "</td> <td>" + data[i].operator + "</td><td>" + data[i].date_time + "</td><td><button class='btn btn-danger' id='btndel' dataid=" + data[i].member_id + ">Delete</button> <button class='btn btn-warning' id='btnupdate' dataid=" + data[i].member_id + ">Update</button></td></tr>"
                    }
                    $('#tbody').html(output)
                }
            })
        }




        $('#tbody').on("click", "#btndel", function () {

            var id = $(this).attr('dataid');
            let ref = this

            $.ajax({
                url: 'MemberManageController/deleteMember',
                method: 'post',
                data: {
                    postedData: id
                },
                success: function (response) {
                    let data = $.parseJSON(response);

                    if (data != 'success') {
                        toastr.error('Member Not Deleted');
                    }
                    toastr.success('Member Deleted succesfully');
                    $(ref).closest('tr').fadeOut(500);
                }
            })
        })



        $('#tbody').on("click", "#btnupdate", function () {
            $("#updatemember").show();
            $("#insertmember").hide();
            var id = $(this).attr('dataid');
            var output = '';
            $.ajax({
                url: 'MemberManageController/showoldData',
                method: 'POST',
                data: {
                    postedData: id
                },
                success: function (res) {

                    let data = $.parseJSON(res);
                    console.log(data)
                    for (let j = 0; j < data.length; j++) {
                        $('#name').val(data[j].name);
                        $('#contact').val(data[j].contact);
                        $('#address').val(data[j].address);
                        $('#age').val(data[j].age);
                        $('#city').val(data[j].city);
                        $('#memberID').val(data[j].member_id).attr('readonly', true);;
                        $('#package').value = data[j].package;
                    }
                }
            })

        })
        $('#updateMember').click(function () {

            var memberID = $('#memberID').val();
            var package = $('#package').val();
            var name = $('#name').val();
            var contact = $('#contact').val();
            var address = $('#address').val();
            var age = $('#age').val();
            var city = $('#city').val();


            if (memberID != '' && package != '' && name != '' && contact != '' && address != '' && age != '' && city != '') {

                $.ajax({
                    type: 'POST',
                    url: 'MemberManageController/updatingMember',
                    data: {
                        memberID: memberID,
                        package: package,
                        name: name,
                        contact: contact,
                        address: address,
                        age: age,
                        city: city
                    },
                    success: function (response) {
                        toastr.success('Member updated succesfully');
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