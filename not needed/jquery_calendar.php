<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="./css/style.css"/>
  <link rel="stylesheet" href="./css/style_calendar.css"/>
  <link rel="stylesheet" href="./css/style_2.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  <script type="text/javascript" src="js/cal_script.js"></script>



  <title>Photographer Portfolio</title>



  <script>
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: 'load.php',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
  </script>
 </head>


 <body>

 <section class="first_block"> 
      <nav class="nav">
        <ul>
          <li class="menu" style="font-size:30px; cursor:pointer;" onclick="openNav()"><i class="fa fa-bars"></i></li>
        </ul>
        <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
          <a href="#portfolio">portfolio</a>
          <a href="#">fashion</a>
          <a href="#">food</a>
          <a href="#">documentary</a>
          <a href="#">family</a>
          <a href="#calendar">calendar</a>
          <a href="#contact">contact</a>
        </div>
      </nav>

      <div class="content">
        <div class="img-at-the-front">
          <img  src="./img/7.jpg" style="height: 550px;"> 
        </div>
        <div class="info">
          <ul>
            <li>diploma work</li>
            <li>@mary_hodis</li>
            <li>Photographer.com</li>
            <li><i class="fa fa-share-alt"></i></li>
          </ul>
        </div>

        <div class="text">
          <h1>mary hodis</h1>
          <p>Photography</p>
        </div>

        <div class="name">mary hodis</div>

        <div class="bottomnav">
          <ul>
            <li><a href="#portfolio">portfolio</a></li>
            <li><a href="#calendar">calendar</a></li>
            <li><a href="#contact">contact</a></li>
          </ul>
        </div>
      </div>
    </section>





    <section id="portfolio" class="second_block">
        <div class="name_of_block">
          <h2>PORTFOLIO</h2>
        </div>
        <!-- Flickity HTML init -->
        <div class="carousel" data-flickity='{ "fullscreen": true, "lazyLoad": 2, "autoPlay": 1500, "wrapAround": true, "pageDots": false, "draggable": false}'>
          <img class="carousel-image" src="./img/IMG_0891-3.jpg" />
          <img class="carousel-image" src="./img/IMG_1011.jpg" />
          <img class="carousel-image" src="./img/IMG_0566.jpg" />
          <img class="carousel-image" src="./img/IMG_0991-2.jpg" />
          <img class="carousel-image" src="./img/IMG_1317-2.jpg" />
          <img class="carousel-image" src="./img/IMG_3943.jpg" />
          <img class="carousel-image" src="./img/IMG_9989.jpg" />
          <img class="carousel-image" src="./img/_MG_0851.JPG" />
        </div>
        <div class="portfolio">
          <div class="row">
            <div class="col">
              <div class="centered">
                <a href="./fashion.html"><img src="./img/Post.png" style="height: 500px;"></a>
              </div>
            </div>
            <div class="col">
              <div class="centered">
                <a href="./fashion.html"><h2 class="name_of_secondblock" >Fashion</h2></a>
                <p style="padding: 0 50px;">Fashion photography is the most interesting and creative part of a photography. 
                  Brands, models, stylists, magazines, online-shops - need to have a fashion photos.
                  I really like this type of photography, because throught this - I can express myself.
                  The entire life consists of small particles, formed as puzzles, forming a huge picture. 
                  I am trying to capture all the important details of each story by bringing across the atmosphere. 
                  Being tirelessly in love with creative work, bright, natural daylight, delicate and present, 
                  that touches the eyes corner from day to day, I am specialized in a pure portrait photography. 
                  It implies natural daylight, free lines, airiness, lightness and softness of tones.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="portfolio">
          <div class="row">
            <div class="col">
              <div class="centered">
                <h2 class="name_of_secondblock">Food</h2>
                <p style="padding: 0 50px;">Fashion photography is the most interesting and creative part of a photography. 
                  Brands, models, stylists, magazines, online-shops - need to have a fashion photos.
                  I really like this type of photography, because throught this - I can express myself.</p>
              </div>
            </div>
            <div class="col">
              <div class="centered">
                <img src="./img/Peach and Gray.png" style="height: 500px;">
              </div>
            </div>
          </div>
        </div>
          <div class="portfolio">
            <div class="row">
              <div class="col">
                <div class="centered">
                  <img src="./img/Background.png" style="height: 500px;">
                </div>
              </div>
              <div class="col">
                <div class="centered">
                  <h2 class="name_of_secondblock">Documentary</h2>
                  <p style="padding: 0 50px;">Fashion photography is the most interesting and creative part of a photography. 
                    Brands, models, stylists, magazines, online-shops - need to have a fashion photos.
                    I really like this type of photography, because throught this - I can express myself.
                    The entire life consists of small particles, formed as puzzles, forming a huge picture. 
                    I am trying to capture all the important details of each story by bringing across the atmosphere. 
                    Being tirelessly in love with creative work, bright, natural daylight, delicate and present, 
                    that touches the eyes corner from day to day, I am specialized in a pure portrait photography. 
                    It implies natural daylight, free lines, airiness, lightness and softness of tones.</p>
                </div>
              </div>
            </div>
          </div>
            <div class="portfolio">
              <div class="row">
                <div class="col">
                  <div class="centered">
                    <h2 class="name_of_secondblock">Family</h2>
                    <p style="padding: 0 50px;">Fashion photography is the most interesting and creative part of a photography. 
                      Brands, models, stylists, magazines, online-shops - need to have a fashion photos.
                      I really like this type of photography, because throught this - I can express myself.</p>
                  </div>
                </div>
                <div class="col">
                  <div class="centered">
                    <img src="./img/Watercolor.png" style="height: 500px;">
                  </div>
                </div>
              </div>
          </div>
    </section>




  <br />
  <h2><a href="#">Jquery Fullcalandar Integration with PHP and Mysql</a></h2>
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>




  <section id="contact" class="fourth_block">
      <div class="name_of_block">
        <h2>CONTACT</h2>
      </div>
      <div class="contact_block">
        <div>
          <img  src="./img/IMG_1011.jpg" style="height: 550px;"> 
        </div>
        
        <div class="contact_form">
          <form method="POST" class="box" action="phpmailer.php">
            <h2>Please, fill in the contact form:</h2>
            <input type="text" name="lastname" placeholder="Last name" id="lastName"/>
            
            <input type="text" name="firstname" placeholder="First name" id="firstName" />
            
            <input type="email" name="email" placeholder="Email" id="email" />
            
            <input type="text" name="country" placeholder="Country" id="country"/>  

            <input type="text" name="message" placeholder="Message" id="message"/>  
            
            <input type="submit" name="submit" value="Submit">
        
          </form>
        </div>
      </div>
    </section>

    

    <footer class="font-small pt-4">
      <div class="footer-copyright"> 
        <h3>Mary Hodis Photography</h3> 
        <p>+48 796 445 265</p>
        <p>maryhodis99@gmail.com</p>
      </div>

      <!-- Footer Elements -->
      <div class="container">

        <!-- Social buttons -->
        <ul class="list-unstyled list-inline text-center">
          
          <li class="list-inline-item">
            <a class="btn-floating btn-tw mx-1">
              <i class="fa fa-instagram"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-li mx-1">
              <i class="fa fa-behance"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-fb">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a class="btn-floating btn-li mx-1">
              <i class="fa fa-linkedin"></i>
            </a>
          </li>
        </ul>
      </div>

      <div class="footer-copyright text-center p">
        <p>© 2020 Copyright:</p>
        <p style="text-align: center;">Mariia Hodis</p>
      </div>
    
    </footer>
  <script>
    TweenMax.to('.left', 2, {
      delay: .8,
      width: '50%',
      ease: Power2.easeInOut
    })

    TweenMax.to('.right', 2, {
      delay: .6,
      width: '50%',
      ease: Power3.easeInOut
    })

    TweenMax.from('.nav', 2, {
      delay: .8,
      opacity: 0,
      ease: Expo.easeInOut
    })

    TweenMax.from('.text h1', 2, {
      delay: .6,
      x: 1000,
      ease: Circ.easeInOut
    })

    TweenMax.from('.text p', 2, {
      delay: .7,
      x: 1000,
      ease: Circ.easeInOut
    })

    TweenMax.to('.karina', 2, {
      delay: 1.5,
      width: '800px',
      ease: Power2.easeInOut
    })

    TweenMax.staggerFrom('.bottomnav ul li', 2, {
      delay: 1,
      x: 1000,
      ease: Circ.easeInOut
    }, 0.08)

    TweenMax.from('.info', 2, {
      delay: 1.5,
      y: 100,
      ease: Circ.easeInOut
    })

    TweenMax.from('.name', 2, {
      delay: 1.5,
      x: -600,
      ease: Circ.easeInOut})
  </script>  
  <script src="assets/js/util.js"></script> <!-- util functions included in the CodyHouse framework -->
  <script src="assets/js/main.js"></script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->


 </body>
</html>