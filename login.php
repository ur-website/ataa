<?php
$host="localhost";
$user="root";
$password="";
$db="user";

session_start();

$data=mysqli_connect($host,$user,$password,$db);

if($data===false) {
    die("Connection error");
}

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $username=$_POST["username"];
    $password=$_POST["password"];

    $sql="SELECT * FROM login WHERE username='".$username."' AND password='".$password."'";
    $result=mysqli_query($data,$sql);
    $row=mysqli_fetch_array($result);

    if($row) {
        $_SESSION["username"]=$username;

        // Redirect based on user type
        if($row["usertype"]=="user") {
            header("location:userhome.php");
            exit;
        } elseif($row["usertype"]=="admin") {
            header("location:adminhome.php");
            exit;
        } elseif($row["usertype"]=="english") {
            header("location:english.php");
            exit;
        }
    } else {
        echo "Username or password incorrect";
    }
}

// Check if the user is already logged in, redirect if true
if(isset($_SESSION['username'])) {
    header('Location: userhome.php'); // or any other appropriate page
    exit;
}
?>




<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>شركة عطاء التعليمية</title>
    <link rel="stylesheet" href="Login.css" />
    <link rel="icon" href="logo .icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body>
    <main>
        <div class="box">
            <div class="carousel">
                <div class="images-wrapper">
                    <img src="Ataa.png" class="image img-1 show" alt="" />
                </div>
            </div>
            <div class="inner-box">
                <div id="toaster"></div>
                <div class="forms-wrap">
                    <form autocomplete="on" class="sign-in-form" action="#" method="post" >
                        <div class="logo">
                            <img src="logo.png" alt="easyclass" />
                        </div>

                        <div class="heading">
                            <h2>أهـــــــــــلا بعــودتــك </h2>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" minlength="4" class="input-field" autocomplete="off"
                                    id="loginUsername" name="username" required/>
                                <label>رقـــــــــــــــــــــم التعريــــــــــــــــــــــــف</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" minlength="4" class="input-field" autocomplete="off"
                                    id="loginPassword" name="password" required/>
                                <label>البـــــــــــــــــــــــــــــــاسورد</label>
                            </div>


                            <button class="sign-btn" onclick="showToaster()" type="submit">تسجيـــــــــــــــــل
                                الـــــــدخول</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
        </div>
    </main>


	<style>
		@import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');

*,
*::before,
*::after {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body,
input {
    font-family: "Tajawal", sans-serif;
    direction: rtl;
}

main {
    width: 100%;
    min-height: 100vh;
    overflow: hidden;
    background-color: #48397c;
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}


.progress.active:before {
    animation: progress 5s linear forwards;
}

.box {
    position: relative;
    width: 120%;
    max-width: 1020px;
    height: 640px;
    background-color: #fff;
    border-radius: 3.3rem;
    box-shadow: 0 60px 40px -30px rgba(0, 0, 0, 0.27);
}

#toaster {
    display: none;
    margin-top: 20px;
    padding: 10px;
    border-radius: 15px;
    text-align: center;
    transition: background-color 0.5s ease-in-out, opacity 0.5s ease-in-out;
}

#toaster.red {
    background-color: #d10000;
}

#toaster.green {
    background-color: #4CAF50;
}

.inner-box {
    position: absolute;
    width: calc(100% - 4.1rem);
    height: calc(100% - 4.1rem);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.forms-wrap {
    position: absolute;
    height: 100%;
    width: 45%;
    top: 0;
    right: 0;
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 1fr;
    transition: 0.8s ease-in-out;
}

form {
    max-width: 260px;
    width: 100%;
    margin: 0 auto;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;
    grid-column: 1 / 2;
    grid-row: 1 / 2;
    transition: opacity 0.02s 0.4s;
}

.logo {
    display: none;
    align-items: center;
}

.logo img {
    width: 150px;
    margin-right: 0.3rem;
}


.heading h2 {
    font-size: 2.1rem;
    font-weight: 600;
    color: #151111;
}

.heading h6 {
    color: #bababa;
    font-weight: 400;
    font-size: 0.75rem;
    display: inline;
}

.toggle {
    color: #151111;
    text-decoration: none;
    font-size: 0.75rem;
    font-weight: 500;
    transition: 0.3s;
}

.toggle:hover {
    color: #8371fd;
}

.input-wrap {
    position: relative;
    height: 37px;
    margin-bottom: 2rem;
}

.input-field {
    position: absolute;
    width: 100%;
    height: 100%;
    background: none;
    border: none;
    outline: none;
    border-bottom: 1px solid #bbb;
    padding: 0;
    font-size: 0.95rem;
    color: #151111;
    transition: 0.4s;
}

label {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.95rem;
    color: #bbb;
    pointer-events: none;
    transition: 0.4s;
}

.input-field.active {
    border-bottom-color: #151111;
}

.input-field.active+label {
    font-size: 0.75rem;
    top: -2px;
}

.sign-btn {
    display: inline-block;
    width: 100%;
    height: 45px;
    background-color: #151111;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 0.8rem;
    font-size: 1rem;
    margin-top: 2rem;
    transition: 0.3s;
    font-family: "Tajawal", sans-serif;
}

.sign-btn:hover {
    background-color: #8371fd;
}

.text {
    color: #bbb;
    font-size: 0.7rem;
}

.text a {
    color: #bbb;
    transition: 0.3s;
}

.text a:hover {
    color: #8371fd;
}


.carousel {
    position: absolute;
    height: 33%;
    width: 55%;
    left: 0;
    top: 25%;
    background-color: #fff;
    border-radius: 2rem;
    display: flex;
    flex-direction: column;
    margin-top: 50px;
    margin-left: 20px;
    overflow: hidden;
    transition: 0.8s ease-in-out;
}

.images-wrapper {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 1fr;
}

.image {
    width: 100%;
    grid-column: 1/2;
    grid-row: 1/2;
    opacity: 0;
    transition: opacity 0.3s, transform 0.5s;
}

.img-1 {
    transform: translate(0, -50px);
}

.img-2 {
    transform: scale(0.4, 0.5);
}

.img-3 {
    transform: scale(0.3) rotate(-20deg);
}

.image.show {
    opacity: 1;
    transform: none;
}

/* .text-slider {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
} */

.text-wrap {
    max-height: 2.2rem;
    margin-bottom: 2.5rem;
}

.text-group {
    display: flex;
    flex-direction: column;
    padding-top: 2.5rem;
    text-align: center;
    transform: translateY(0);
    transition: 0.5s;
}

.text-group h2 {
    line-height: 2.2rem;
    font-weight: 600;
    font-size: 1.6rem;
}

.bullets {
    display: flex;
    align-items: center;
    justify-content: center;
}

.bullets span {
    display: block;
    width: 0.5rem;
    height: 0.5rem;
    background-color: #aaa;
    margin: 0 0.25rem;
    border-radius: 50%;
    cursor: pointer;
    transition: 0.3s;
}

.bullets span.active {
    width: 1.1rem;
    background-color: #151111;
    border-radius: 1rem;
}

@media (max-width: 850px) {
    .box {
        height: auto;
        max-width: 550px;
        overflow: hidden;
    }

    .inner-box {
        position: static;
        transform: none;
        width: revert;
        height: revert;
        padding: 2rem;
    }

    .forms-wrap {
        position: revert;
        width: 100%;
        height: auto;
    }

    form {
        max-width: revert;
        padding: 1.5rem 2.5rem 2rem;
        transition: transform 0.8s ease-in-out, opacity 0.45s linear;
    }

    .carousel {
        position: revert;
        height: auto;
        width: 100%;
        padding: 3rem 2rem;
        display: flex;
    }

    .logo {
        display: none;
        align-items: center;
        justify-content: center;
    }

    .logo  img{
        width: 100px;
    }

    /* .images-wrapper {
        display: none;
    } */

    .text-slider {
        width: 100%;
    }
}

@media (max-width: 530px) {
    main {
        padding: 1rem;
    }

    .box {
        border-radius: 2rem;
    }

    .inner-box {
        padding: 1rem;
    }

    .carousel {
        padding: 1.5rem 1rem;
        border-radius: 1.6rem;
    }

    .text-wrap {
        margin-bottom: 1rem;
    }

    .text-group h2 {
        font-size: 1.2rem;
    }

    form {
        padding: 1rem 2rem 1.5rem;
    }
}

	</style>

	<script>
		const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

inputs.forEach((inp) => {
    inp.addEventListener("focus", () => {
    inp.classList.add("active");
});
    inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
});
});

	</script>
</body>

</html>