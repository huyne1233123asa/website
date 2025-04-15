
<?php
session_start(); 
require("config.php");


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST["dangnhap"]) && isset($_POST["email"]) && isset($_POST["password"]) && $_POST["email"] != '' && $_POST["password"] != '') {
    $conn = mysqli_connect('localhost', 'root', '', 'webshop');

    // Kiểm tra kết nối
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Thực hiện xử lý khi người dùng ấn nút submit và điền đầy đủ thông tin.
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    // Mã hóa password 
    $password = md5($password);
    $sql = "SELECT * FROM dangki WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        // Tạo ra 1 phiên lưu trữ tạm thời dữ liệu lên hệ thống    
        $_SESSION['id'] = $row['id'];
        $_SESSION['ho'] = $row['ho'];
        $_SESSION['ten'] = $row['ten'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION["thong_bao"] = "Đăng nhập thành công";
        header("location: home.php");
        exit();
    } else {
        $_SESSION["thong_bao"] = "Email hoặc mật khẩu nhập không đúng";
        header("location: trangdangnhap.php");
        exit();
    }
}// else {
   // $_SESSION["thong_bao"] = "Vui lòng điền đầy đủ thông tin.";
   // header("location: trangdangnhap.html");
   // exit();


	//else{
	//	$_SESSION["thong_bao"] = "Vui lòng nhập đầy đủ thông tin";
		//header("location: trangdangnhap.php");
	//	exit();
  //  }
	//}

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // $username = $_POST['username'];
  //  $password = $_POST['password'];
    
  //  $sql = "SELECT id, username, password  FROM users WHERE username = ? ";
  //  $stmt = $conn->prepare($sql);
  //  $stmt->bind_param("s", $username);
  //  $stmt->execute();
  //  $stmt->store_result();
//
   //     if ($stmt->num_rows > 0) {
   //     $stmt->bind_result($id, $username, $password);
   //     $stmt->fetch();
        
   //     if (password_verify($password)) {
    //        $_SESSION['user_id'] = $id;
    //        $_SESSION['username'] = $username;
        //     $_SESSION['password'] = $password;
        //    header("Location: Trangchu.html");
       //     exit();
      //  } else {
      //      $error = "Mật khẩu không đúng.";
      //  }
  //  } else {
  //      $error = "Username không tồn tại.";
   // }
//
 //   $stmt->close();

?>
