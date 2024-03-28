<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/cssmain.css">

    <title>Wedding</title>
</head>

<body>

    <!--! ---------------------------------- Head Bar Start ---------------------------------- -->

    <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="mx-auto d-sm-flex d-block flex-sm-nowrap">
            <a class="navbar-brand" href="#">Faikham Hotel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarsExample11">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">หน้าเเรก</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="room_information.php">ข้อมูลห้องพัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="promotion.php">โปรโมชั่น</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="release.php" style="color: rgb(124, 134, 83);">ข่าวสารประชาสัมพันธ์</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="btn btn-primary"
                            href="https://www.google.com/search?q=food+4k&tbm=isch&ved=2ahUKEwiM3PjQ8Lb4AhWyidgFHZqZAo8Q2-cCegQIABAA&oq=food+&gs_lcp=CgNpbWcQARgAMgQIIxAnMgQIABBDMgQIABBDMgcIABCxAxBDMgQIABBDMgcIABCxAxBDMgcIABCxAxBDMgQIABBDMgQIABBDMggIABCABBCxA1CUA1iUA2DzCGgAcAB4AIABR4gBjAGSAQEymAEAoAEBqgELZ3dzLXdpei1pbWfAAQE&sclient=img&ei=rLStYozWIrKT4t4PmrOK-Ag&bih=937&biw=1920"
                            role="button">Book Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--! ---------------------------------- Head Bar End ----------------------------------  -->

    <!--! ---------------------------------- Body Show Start ----------------------------------  -->

    <!--? Carousel Start -->
    <div class="setcarouel">
        <div class="col-lg-6 m-auto px-5 py-2">

            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" style="padding-top: 20px;">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active " data-bs-interval="5000">
                        <img src="img/6.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>อะไรก็อร่อยมากครับผม</h1>
                            <p>ขอเซ็ตหย่อ สูดต่อ ซูดผ่อ สี่หม่อสองห่อ ใส่ไข่</p>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="img/6.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>อะไรก็อร่อยมากครับผม</h1>
                            <p>ขอเซ็ตหย่อ สูดต่อ ซูดผ่อ สี่หม่อสองห่อ ใส่ไข่</p>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="img/6.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h1>อะไรก็อร่อยมากครับผม</h1>
                            <p>ขอเซ็ตหย่อ สูดต่อ ซูดผ่อ สี่หม่อสองห่อ ใส่ไข่</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!--? Carousel End -->

        <div class="col-md-8 m-auto">

            <div class="col-md-6 m-auto">
                <p class="textset1" style="padding: 25px;">Contact & Location</p>
            </div>

            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            ช่องทางติดต่อที่ 1 Facebook
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            <a href="https://www.facebook.com/profile.php?id=100051073366430" class="link-primary">FAIKHAM Boutique ฝ้ายคำ บูธีค เชียงใหม่-แยกบวกครกศิวิไล </a>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            ช่องทางติดต่อที่ 2 เบอร์คุณสุ
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            089-191-2737
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                            ช่องทางติดต่อที่ 2 เบอร์คุณติงลี่
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            <p class="linebreakin">
                                091-079-9081
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--! ---------------------------------- Body Show End ----------------------------------  -->

        <!--! ---------------------------------- Footer Start ----------------------------------  -->
        <div class="col-lg-12 m-auto p-auto">
            <ul class="nav justify-content-center bg-light" style="margin-top: 40px;">
                <li class="nav-item">
                    <a class="nav-link active" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.html">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.facebook.com/profile.php?id=100051073366430">Social
                        Media</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Wedding</a>
                </li>
                <!-- <li class="nav-item">
                          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li> -->
            </ul>
        </div>
        <!--! ---------------------------------- Footer End ----------------------------------  -->

        <!-- ? ---------------------------------- End Script ---------------------------------- -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
        <!-- ? ---------------------------------- End Script ---------------------------------- -->
</body>

</html>