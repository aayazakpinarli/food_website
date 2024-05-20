<?php
session_start();

function headers()
{
include "database/conf.php";
    echo ' 
    
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title> Food Website </title>

            <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <!-- font awesome cdn link  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/waitme@1.19.0/waitMe.min.css">
        <!-- custom css file link  -->
        <link rel="stylesheet" href="admin/css/-variables.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/inv.css">

    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/login.css">
    

        
    <!-- header section starts  -->
        </head>
        <body>
    <header class="d-flex">
    
        <a href="#" class="logo"><i class="fas fa-utensils "></i>CodersMarket</a>
    
        <nav class="navbar">
            <a class="active" href="#home">home</a>
            <a href="#products">products</a>
            <a href="#about">about</a>
            <a href="admin/index.php" id="adminLink">Market Panel</a>
                 </nav>
    
        <div class="icons">
            <i class="fas fa-bars" id="menu-bars"></i>
     
                <a class="fas fa-search" id="search-icon"></a>                               
                        <a  id="CartCount" class="fas fa-shopping-cart cart_show"></a>
                        </div>
                    <div class="user" id="user_login_header"></div>
                        
                    </div>

    </header>
    
    <!-- header section ends-->
    
    <!-- search form  -->
    ';
    search();
};
function banners()
{


    echo ' <!-- home section starts  -->
            <section class="home" id="home">
            
                <div class="swiper-container home-slider " style="overflow-x:hidden ;">
            
                    <div id="banner_Container" class="swiper-wrapper wrapper" >
            
            
                    </div>
            
                    <div class="swiper-pagination"></div>
            
                </div>
            
            </section>
            
            <!-- home section ends -->
            ';
};
function search()
{
    echo ' <form id="search-form">
    <div class="inner-form">
      <div class="close_btn">X</div>
      <div class="basic-search">
        <div class="input-field">
          <div class="">
            <input
              id="SearchInput"
              type="text"
              class="text-white"
              placeholder="Search..."
             
            />
            <button class="search-btn">search</button>
          </div>
        </div>
        <div class="search-term d-none">
          <ul class="">
            <li>search</li>
            <li>search</li>
            <li>search</li>
            <li>search</li>
            <li>search</li>
            <li>search</li>
            <li>search</li>
          </ul>
        </div>
      </div>
    </div>
  </form>
    ';
}
function msgModals(){
    echo '

    <div class="modal fade " id="MsgModel" tabindex="1062" role="dialog">
        <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title"></h5>
                  <a type="button" class="  close " data-dismiss="modal" aria-label="Close">
                      <span class="dpanel-text">X</span>
                  </a>
                  </div>
                  <div class="modal-body">
                  <p id="Model_txt"></p>
                  </div>
                  <div class="modal-footer">
                  
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                  </div>
              </div>
        </div>
    </div>';
}
function search_result()
{
    echo '
    <section class="dishes d-none" id="search_main_container">
         <div class="title-head">
         
        <h3 class="sub-heading"> your search data </h3>
        <h1 class="heading"> search dishes </h1>
        </div>   

            <div id="search_msg"></div>
            <div class="box-container" id="search_containers">
                    <div class="row" id="search_gallery">
                    </div>
            </div>
    </section>
    ';
}
function loadtabel()
{
    echo '<div class="container mt-5">
    <div class="table-responsive " id="cart_tabel">
        <table  class="table table-striped-columns
        ">
        <thead class="tabel-info bg ">
        
                <tr class="bg text-white">
                    <th>Sno:</th>
                    <th>image</th>
                    <th>title</th>
                    <th>qty</th>
                    <th>prize</th>
                    <th>Total prize</th>
                    <th><button class="btn btn-danger" id="delete_all"> Delete All</button> </th>
                    </tr>
                    </thead>
                    <tbody class="" id="cart_data_show">
                    
                    <caption class="w-100">
                    <span  class= "ml-5">   Grand total : <b  id="crt_amt"></b> </span>
                     <button role="button" id="crt_inv_shw_btn"  class=" mr-5 float-end btn "> buying</button>
                     </caption>
                </tbody>
         </table>
    </div>
    
    </div>';
}

function dishes()
{

    echo '

    <!-- dishes section starts  -->
    
    <section class="dishes" id="dishes">
    <div class="title-head">
        <h3 class="sub-heading"> our products </h3>
        <h1 class="heading"> popular products </h1>
        </div>
    
        <div  id="p_msg"></div>
        <div class="box-container" id="dishes_containers">
                <div class="row" id="product_gallery">
                

                </div>
        </div>
    
    </section>
    
    <!-- dishes section ends ----->';
};
    
function introduction()
{
    echo '<!-- about section starts  -->

            <section class="about" id="about">
            <div class="title-head">
                <h3 class="sub-heading"> about us </h3>
                <h1 class="heading"> why choose us? </h1>
            </div>
                <div class="row">

                    <div class="image">
                        <img src="images/codingm.png" alt="">
                    </div>

                    <div class="content">
                        <h3>best market in the country</h3>
                        <p>At our market, we are proud to offer you great food that tastes amazing and is always fresh. We work with local farmers and trusted suppliers to make sure you get the best fruits, vegetables, meats, and dairy products.</p>
                        <p>Our food is picked for its quality and flavor, so you can enjoy really good meals every day. When you shop with us you are getting top-notch, fresh food and supporting local producers too. Come visit us for great food that keeps you and your family healthy and happy! </p>
                        <div class="icons-container">
                       
                        <div class="icons">
                                <i class="fas fa-shipping-fast"></i>
                                <span>free delivery</span>
                            </div>
                            <div class="icons">
                                <i class="fas fa-dollar-sign"></i>
                                <span>easy payments</span>
                            </div>
                            <div class="icons">
                                <i class="fas fa-headset"></i>
                                <span>24/7 service</span>
                            </div>
                        </div>
                        <a href="#" class="btn">learn more</a>
                    </div>

                </div>

            </section>

            <!-- about section ends -->
            ';
};
function special_menu()
{
    echo '
            <!-- menu section starts  -->

            <section class="menu" id="menu">
            <div class="title-head">
                <h3 class="sub-heading"> our menu </h3>
                </div>
                <div class="box-container" id="menu_container">
                <div class="row" id="WeeklyProGall">
                

                </div>

                </div>

            </section>

            <!-- menu section ends -->
            ';
};


function sign_up()
{
    echo '
    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content d-md-flex ">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" action="database/sign_up.php" class="register-form" id="register-form" enctype="multipart/form-data">
                            <div class="alert alert-danger" id="message" style="display: none;" role="alert"></div>
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i></label>
                                <input type="text" name="name" id="name" required placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i></label>
                                <input type="email" name="email" id="email" required placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="fas fa-lock"></i></label>
                                <input type="password" name="pass" id="pass" required placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="fas fa-lock"></i></label>
                                <input type="password" name="re_pass" id="re_pass" required placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <label for="city"><i class="fas fa-user"></i></label>
                                <input type="text" name="city" id="city" required placeholder="City"/>
                            </div>
                            <div class="form-group">
                                <label for="district"><i class="fas fa-user"></i></label>
                                <input type="text" name="district" id="district" required placeholder="District"/>
                            </div>
                            <div class="form-group">
                                <label for="address"><i class="fas fa-user"></i></label>
                                <input type="text" name="address" id="address" required placeholder="Address"/>
                            </div>
                            <div class="form-group">
                                <label for="user_type"><i class="fas fa-user"></i></label>
                                <select name="user_type" id="user_type" required>
                                    <option value="" disabled selected>Select User Type</option>
                                    <option value="1">Market User</option>
                                    <option value="2">Consumer User</option>
                                </select>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sign up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already member <u class="text-info" style="text-decoration: underline;">sign in</u></a>
                    </div>
                </div>
            </div>
        </section>
    </div>';
}




function sign_in()
{

    echo '
    <div class="main">  
          <section class="sign-in">
            <div class="container">
                <div class="signin-content d-md-flex">
                <div class="row">
                <div class="col-6">
                 
                                <div class="signin-image">
                                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                                        
                                    </div>
                            </div> 
                            <div class="col-6">
                            
                    <div class="signin-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" id="login-form">
                    <div class="alert alert-danger mb-2 " id="message" style="" role="alert"></div> 
                        <div class="form-group">
                            <label for="your_name"><i class="fas fa-user "></i></label>
                            <input type="text" name="email" id="your_name" required placeholder="Enter your email"/>
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="fas fa-lock"></i></label>
                            <input type="password" name="pass" id="your_pass" required placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="button" role="button" name="signin" id="signin" onclick="login()" class="form-submit" value="Log in"/>
                        </div>
                    </form>
               
                </div>
                            </div>

                
                    <div class="col-6">
                    <a href="register.php" class="signup-image-link position-absolute ">Create an account <u class=" text-info ">Sign in</u> </a>
                    </div>
                    </div>
                </div>
            </div>
        </section>

        </div>
        ';
};

function footers()
{
    echo ' 
    <!-- footer section starts  -->
    
    <section class="footer">
    
        <div class="box-container">
    
            <div class="box">
                <h3>locations</h3>
                <a href="#">Ankara</a>
                <a href="#">İstanbul</a>
                <a href="#">İzmir</a>
                <a href="#">Eskişehir</a>
                <a href="#">Bursa</a>
            </div>
    
            <div class="box">
                <h3>quick links</h3>
                <a href="#">home</a>
                <a href="#">dishes</a>
                <a href="#">about</a>
                <a href="#">menu</a>
            </div>
    
            <div class="box">
                <h3>contact info</h3>
                <a href="#">+90 534 584 16 65</a>
                <a href="#">+90 530 266 86 45</a>
                <a href="#">eaykose@gmail.com</a>
                <a href="#">egehan@gmail.com</a>
            </div>
    
        </div>
    
    
    </section>
    
    <!-- footer section ends -->
    <!-- Plugin js for this page -->
    
    <script src="js/jquery.min.js"></script>
     <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js "></script>
    
     <!-- End plugin js for this page -->
     
   
    <!-- custom js file link  -->
    <script type="module" src="js/script.js"></script>
    <script src="js/fetch.js"></script>
    
       
      
    <script src="database/js/ajax.js"></script>  
    
    <script>
    
    </script>
    
    
    </body>
    </html>';
};
