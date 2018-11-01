<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
</head>

<body>

  <form method="post" id="insert_form">
    <label>Enter Employee Name</label>
    <input type="text" name="name" id="name" class="form-control" />
    <br />
    <label>Enter Employee Address</label>
    <textarea name="address" id="address" class="form-control"></textarea>
    <br />
    <label>Select Gender</label>
    <select name="gender" id="gender" class="form-control">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    <br />
    <label>Enter Designation</label>
    <input type="text" name="designation" id="designation" class="form-control" />
    <br />
    <label>Enter Age</label>
    <input type="text" name="age" id="age" class="form-control" />
    <br />
    <input type="hidden" name="employee_id" id="employee_id" />
    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
  </form>

</body>

<script type="text/javascript">
  $('#insert_form').on("submit", function(event) {
    event.preventDefault();
    if ($('#name').val() == "") {
      alert("Name is required");
    } else if ($('#address').val() == '') {
      alert("Address is required");
    } else if ($('#designation').val() == '') {
      alert("Designation is required");
    } else if ($('#age').val() == '') {
      alert("Age is required");
    } else {
      $.ajax({
        url: "insert.php",
        method: "POST",
        data: $('#insert_form').serialize(),
        beforeSend: function() {
          $('#insert').val("Inserting");
        },
        success: function(data) {
          $('#insert_form')[0].reset();
          $('#add_data_Modal').modal('hide');
          $('#employee_table').html(data);
        }
      });
    }
  });
</script>

</html>

<?php
$connect = mysqli_connect("localhost", "root", "", "testing");
if(!empty($_POST))
{
     $output = '';
     $message = '';
     $name = mysqli_real_escape_string($connect, $_POST["name"]);
     $address = mysqli_real_escape_string($connect, $_POST["address"]);
     $gender = mysqli_real_escape_string($connect, $_POST["gender"]);
     $designation = mysqli_real_escape_string($connect, $_POST["designation"]);
     $age = mysqli_real_escape_string($connect, $_POST["age"]);
     if($_POST["employee_id"] != '')
     {
          $query = "
          UPDATE tbl_employee
          SET name='$name',
          address='$address',
          gender='$gender',
          designation = '$designation',
          age = '$age'
          WHERE id='".$_POST["employee_id"]."'";
          $message = 'Data Update
     }
     else
     {
          $query = "
          INSERT INTO tbl_employee(name, address, gender, designation, age)
          VALUES('$name', '$address', '$gender', '$designation', '$age');
          ";
          $message = 'Data Inserted';
     }
     if(mysqli_query($connect, $query))
     {
          $output .= '<label class="text-success">' . $message . '</label>';
          $select_query = "SELECT * FROM tbl_employee ORDER BY id DESC";
          $result = mysqli_query($connect, $select_query);
          $output .= '
               <table class="table table-bordered">
                    <tr>
                         <th width="70%">Employee Name</th>
                         <th width="15%">Edit</th>
                         <th width="15%">View</th>
                    </tr>
          ';
          while($row = mysqli_fetch_array($result))
          {
               $output .= '
                    <tr>
                         <td>' . $row["name"] . '</td>
                         <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>
                         <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>
                    </tr>
               ';
          }
          $output .= '</table>';
     }
     echo $output;
}
?>
