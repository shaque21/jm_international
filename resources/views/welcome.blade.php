<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JM INTERNATIONAL</title>
    <link rel="icon" href="{{asset('contents/admin')}}/assets/img/icon.ico" type="image/x-icon"/>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('contents/frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('contents/frontend/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('contents/frontend/css/style.css') }}">

    
  </head>
  <body>
    <!-- Upper section -->
     
    <!-- header section -->
    <header id="header">
      <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
        <div class="container">
          <a class="navbar-brand" href="#">
            <i class="fas fa-suitcase-medical"></i>
            JM.<span>INTERNATIONAL</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0 text-center">
              <li class="nav-item">
                <a class="nav-link active" href="#home">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#product">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#contact">Contact Us</a>
              </li>
            </ul>
          </div>
          <div class="d-flex my-2 ms-2">
            <a class="login me-2 font-weight-bold href="">
              <i class="fab fa-whatsapp me-2"></i> WhatsApp
            </a>
          </div>
        </div>
      </nav>
    </header>
    
    <!-- banner section -->
    <div id="home" class="container-fluid banner-section p-4 my-5">
      <div class="container">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-sm-6 banner-content mt-3">
                  <div class="title">
                    <h4 data-aos="fade-down">MaxQueen</h4>
                  </div>
                  <div class="heading-text" data-aos="fade-up-right">
                    <h1>Our New Product</h1>
                  </div>
                  <div class="description">
                    <p class="text-muted" data-aos="fade-up">
                      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Qui perspiciatis nobis corporis reprehenderit vel? Deleniti laborum fugiat architecto iure nesciunt?
                    </p>
                  </div>
                </div>
                <div class="col-sm-6 banner-image" data-aos="fade-up-left">
                  <div class="image">
                    <img src="images/bg/bgm1.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-sm-6 banner-content mt-3">
                  <div class="title">
                    <h4 data-aos="fade-down">MaxQueen</h4>
                  </div>
                  <div class="heading-text" data-aos="fade-up-right">
                    <h1>Our New Product</h1>
                  </div>
                  <div class="description">
                    <p class="text-muted" data-aos="fade-up">
                      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Qui perspiciatis nobis corporis reprehenderit vel? Deleniti laborum fugiat architecto iure nesciunt?
                    </p>
                  </div>
                </div>
                <div class="col-sm-6 banner-image" data-aos="fade-up-left">
                  <div class="image">
                    <img src="images/bg/bgm1.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-sm-6 banner-content mt-3">
                  <div class="title">
                    <h4 data-aos="fade-down">MaxQueen</h4>
                  </div>
                  <div class="heading-text" data-aos="fade-up-right">
                    <h1>Our New Product</h1>
                  </div>
                  <div class="description">
                    <p class="text-muted" data-aos="fade-up">
                      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Qui perspiciatis nobis corporis reprehenderit vel? Deleniti laborum fugiat architecto iure nesciunt?
                    </p>
                  </div>
                </div>
                <div class="col-sm-6 banner-image" data-aos="fade-up-left">
                  <div class="image">
                    <img src="images/bg/bgm1.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="next-prev-btn">
            <button class="left" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <i class="fas fa-chevron-circle-left"></i>
            </button>
            <button class="right mx-sm-2" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <i class="fas fa-chevron-circle-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- end header section -->
    

    <!-- Category section -->
    <div id="product" class="bg-light container-fluid about-us my-3 p-3" data-aos="fade-down">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h2 class="about-title">Our Products</h2>
                </div>
            </div>
    
            @foreach ($products as $key => $item)
                @if($key % 2 == 0)
                    <!-- Image on Left, Text on Right for even indices (0, 2, 4...) -->
                    <div class="row my-5 align-items-center">
                        <div class="col-md-6" data-aos="fade-up-right">
                            <div class="about-img">
                                <img src="{{ asset('uploads/products/' . $item->product_img) }}" alt="{{ $item->product_name }}" class="img-fluid rounded">
                            </div>
                        </div>
                        <div class="col-md-6 p-5 product_name_section" data-aos="fade-up-left">
                            <h4 class="choose">{{ $item->product_name }}</h4>
                            <h2>{{ $item->generic_name }}</h2>
                            <p class="text-muted">{{ $item->packing }}</p>
                            <p class="text-muted"><strong>Specifications:</strong> {{ $item->specification }}</p>
                            <p class="text-muted">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam sunt nobis voluptatum 
                                suscipit, nulla autem aspernatur soluta, nam nostrum quidem delectus ratione impedit 
                                velit? Ex reprehenderit blanditiis dolores...
                            </p>
                        </div>
                    </div>
                @else
                    <!-- Text on Left, Image on Right for odd indices (1, 3, 5...) -->
                    <div class="row my-5 align-items-center">
                        <div class="col-md-6 p-5 product_name_section" data-aos="fade-up-left">
                            <h4 class="choose">{{ $item->product_name }}</h4>
                            <h2>{{ $item->generic_name }}</h2>
                            <p class="text-muted">{{ $item->packing }}</p>
                            <p class="text-muted"><strong>Specifications:</strong> {{ $item->specification }}</p>
                            <p class="text-muted">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam sunt nobis voluptatum 
                                suscipit, nulla autem aspernatur soluta, nam nostrum quidem delectus ratione impedit 
                                velit? Ex reprehenderit blanditiis dolores...
                            </p>
                        </div>
                        <div class="col-md-6" data-aos="fade-up-right">
                            <div class="about-img">
                                <img src="{{ asset('uploads/products/' . $item->product_img) }}" alt="{{ $item->product_name }}" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    
    
    <!-- end Category section -->
  <!-- about us section -->

    <div id="about" class="bg-white about-us my-3 p-3" data-aos="fade-down">
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-center align-items-center">
            <h2 class="about-title">About Us</h2>
          </div>
        </div>
        <div class="row my-3">
          <div class="col-md-6" data-aos="fade-up-right">
            <div class="about-img">
              <img src="{{asset('contents/frontend/images/bg/about1.jpg')}}" alt="">
            </div>
          </div>
          <div class="col-md-6 p-5" data-aos="fade-up-left">
            <h4 class="choose">Why You Choose Us ?</h4>
            <h2>What Makes Our Services Attractive!</h2>
            <p class="text-muted">
              Founded in 2009, [Your Company Name] has been dedicated to improving healthcare through the development 
              and delivery of high-quality, innovative, and affordable medicines...
              <span class="more-text">
                Over the years, we have grown from a 
                small startup with a vision to a trusted name in the pharmaceutical industry, serving patients and healthcare 
                providers worldwide.At the heart of our mission is a commitment to enhancing lives by addressing diverse 
                medical needs. Our comprehensive portfolio includes a wide range of prescription drugs, over-the-counter 
                medications, and wellness products designed to support better health outcomes for individuals and communities.
              </span>
            </p>
            <button class="login " onclick="toggleText()">
              <i class="fas fa-info-circle"></i>&nbsp; Read More
            </button>
          </div>
        </div>
      </div>
    </div>
  <!-- about us section end -->

  <!-- contact us -->
  <div id="contact" class="bg-light contact-us my-3 p-3" data-aos="fade-down">
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center">
          <h2 class="about-title">Contact Us</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4" data-aos="fade-right">
          <div class="row my-3">
            <div class="col-12 p-4 address-head">
              <i class="fas fa-map"></i>&nbsp;&nbsp; Our Address
            </div>
          </div>
          <div class="row my-4">
            <div class="col-12 p-0">
              <div class="card address-content-card  p-4">
                <div class="row py-2">
                  <div class="col-4 text-center address-icon">
                    <i class="fas fa-phone-flip text-success"></i>
                  </div>
                  <div class="col-8 address-content">
                    <p>Phone Number</p>
                    <p class="text-muted muted-font">+880 1627 309821</p>
                  </div>
                </div>
                <hr class="my-2">
                <div class="row py-2">
                  <div class="col-4 text-center address-icon">
                    <i class="fab fa-whatsapp text-success"></i>
                  </div>
                  <div class="col-8 address-content">
                    <p>WhatsApp</p>
                    <p class="text-muted muted-font">+880 1627 309821</p>
                  </div>
                </div>
                <hr class="my-2">
                <div class="row py-2">
                  <div class="col-4 text-center address-icon">
                    <i class="fas fa-envelope text-danger"></i>
                  </div>
                  <div class="col-8 address-content">
                    <p>Email Address</p>
                    <p class="text-muted muted-font">jm.international@gmail.com</p>
                  </div>
                </div>
                <hr class="my-2">
                <div class="row py-2">
                  <div class="col-4 text-center address-icon">
                    <i class="fas fa-globe text-info"></i>
                  </div>
                  <div class="col-8 address-content">
                    <p>Website</p>
                    <p class="text-muted muted-font">www.xyz.com</p>
                  </div>
                </div>
                <hr class="my-2">
                <div class="row py-2">
                  <div class="col-4 text-center address-icon">
                    <i class="fas fa-map-marker-alt text-primary"></i>
                  </div>
                  <div class="col-8 address-content">
                    <p>Office Location</p>
                    <p class="text-muted muted-font">
                      New Elephant Road, Dhaka.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-7 offset-md-1" data-aos="fade-left">
          <div class="row my-3">
            <div class="col-12 p-4  address-head">
              <i class="fas fa-layer-group"></i>&nbsp;&nbsp; Contact Form
            </div>
          </div>
          <div class="row my-4">
            <div class="col-12 p-0 ">
              <div class="card address-content-card  p-4">
                <form action="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control custom-control" id="floatingInput" placeholder="Samsul Haque">
                        <label for="floatingInput" class="custom-label">Full Name</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control custom-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput" class="custom-label">Email address</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control custom-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput" class="custom-label">Mobile Number</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control custom-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput" class="custom-label">Subject</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-floating my-3">
                        <textarea class="form-control custom-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2" class="custom-label">Message...</label>
                      </div>
                      <div class="my-4 d-flex justify-content-center align-items-center">
                        <button type="submit" class="login">
                          <i class="fas fa-paper-plane"></i> &nbsp;&nbsp; Submit Message
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- contact us end -->

    <footer class="my-4">
      <div class="container">
          <div class="row">
              <div class="col-md-12 d-flex justify-content-center align-items-center">
                  All ©Copy Right Are Riserved 2025
              </div>
          </div>
      </div>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('contents/frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('contents/frontend/js/aos.js')}}"></script>
    <script>

    function toggleText() {
      var moreText = document.querySelector('.more-text');
      var readMoreButton = document.querySelector('.read-more');
      
      if (moreText.style.display === "none") {
          moreText.style.display = "inline";
          readMoreButton.innerHTML = "Read Less";
      } else {
          moreText.style.display = "none";
          readMoreButton.innerHTML = "Read More";
      }
    }

      
      var nav = document.querySelector('nav');

      window.addEventListener('scroll', function () {
        if (window.pageYOffset > 40) {
          nav.classList.add('bg-white', 'shadow');
        } else {
          nav.classList.remove('bg-white', 'shadow');
        }
      });

      $(document).ready(function(){

        $('.buttons').click(function(e){

            e.preventDefault();

            // $(this).addClass('active').siblings().removeClass('active');

            const filter = $(this).attr('data-filter')

            if(filter == 'all'){
                $('.category-div').show();
            }else{
                $('.category-div').not('.'+filter).hide();
                $('.category-div').filter('.'+filter).show();
            }

        });

});
AOS.init({
        offset:250,
        duration:1000,
      });
    </script>
  </body>
</html>
