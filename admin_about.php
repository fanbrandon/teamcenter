<?php
session_start();

include("database.php");
include("functions.php");

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>About</title>
    <!-- Link to the JavaScript file -->
</head>
<body>

    <div class="container">
        <div class="content">
            <header>
                <img src="images/saclogo.png" alt="Logo">
                <nav>
                    <a href="admin_home.php">Home</a>
                    <a href="admin_about.php">About</a>
                    <a href="admin_events.php">Events</a>
                    <a href="admin_questions.php">Questions</a>
                    <a href="volunteers.php">Volunteers</a>
                </nav>
                <div class="logout"><a href="index.php">Log Out</a></div>
            </header>
            <main class="aboutcontent" style="color: white;">
                <h2 class="title" id="ourmission" style="color:#C5B682">Our Product</h2>
                <p class="paragraph">This volunteer manangment system is intended to streamline the process of registering for
                    CSUS Career Center events. The CSCU Career Center can easily add events and manage the volunteers of those events.
                </p>
                <h2 class="title" style="color:#C5B682;">Our Team</h2><br>
        
                <div class="grid">
                    <div class="box">
                        <p class="leaders">Brandon Fan</p>
                        

                    </div>
        
                    <div class="box">
                        <p class="leaders">Harman Bassi</p>
                        

                    </div>
        
                    <div class="box">
                        <p class="leaders">Taekjin Jung</p>
                        

                    </div>

                    <div class="box">
                        <p class="leaders">Sukhjot Singh</p>
                        

                    </div>

                    <div class="box">
                        <p class="leaders">Gevik Ohanian</p>
                        

                    </div>

                    <div class="box">
                        <p class="leaders">Rajesh Suresh</p>
                        

                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="container2">
                    <div class="box2"data-aos="fade-in"data-aos-duration="2000">
                        <h2 class="title2" style="color:#C5B682">User Features</h2>
                        <ul class="bulletlist">
                            <br>
                            <li>Easily view any available events from the CSUS Career Center</li><br>
                            <li>Quickly register for an event at the click of a button </li><br>
                            <li>Discussion Board to asks any questions regarding events</li><br>
                            <li>A personal profile page to update about yourself, experience and accommodations</li> 
                        </ul>
                    </div>

                        <hr style="color:rgb(4, 53, 36);">
                    <div class="box2" data-aos="fade-in"data-aos-duration="2000">
                        <h2 class="title2"style="color:#C5B682">Admin Features</h2>
                        <ul class="bulletlist2">
                            <br>
                            <li>Easily add events.</li><br>
                            <li>Manage all registered volunteers with ease and assign tasks to volunteers</li><br>
                            <li>Discussion board to answers any questions from volunteers</li>
                        </ul>
                    </div>
                </div>
                <section class="container2"data-aos="fade-in"data-aos-duration="2000">
                    <div class="slider-wrapper">
                        <div class="slider">
                            <img id="slide-1" src="images/slide1.jpeg" alt="Picture from Career Center event">
                            <img id="slide-2" src="images/slide2.jpg" alt="Picture from Career Center event">
                            <img id="slide-3" src="images/slide3.jpg" alt="Picture from Career Center event">
                        </div>
                        <div class="slider-nav">
                            <a href="#slide-1"></a>
                            <a href="#slide-2"></a>
                            <a href="#slide-3"></a>
                        </div>
                    </div>
                </section>
                <br>
            </main>
        </body>
        </div>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
          AOS.init();
        </script>
</body>
</html>