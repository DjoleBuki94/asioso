<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Asioso</title>
    <meta name="distribution" content="Global"/>
    <meta name="language" content="en"/>
    <meta name="description" content="Asioso">
    <meta name="keywords" content="Asioso, metakey, words">
    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css" />
    <!-- Main css -->
    <link href="../assets/css/main.css" rel="stylesheet">
    <!-- Blog css -->
    <link href="../assets/css/blog.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
</head>
<body>

<nav class="navbar navbar-expand-xl navbar-dark">
  <div class="container">
    <a href="index.php" class="navbar-brand">
        <img src="../assets/images/logo.png" alt="Asioso" class="logo-navbar-w">
    </a>
    <button class="navbar-toggler" type="button" 
      data-bs-toggle="collapse"
      data-bs-target="#navbarText"
      aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <div class="navbar-nav ms-auto">
        <a class="nav-item nav-link" aria-current="page" href="../index.php">Home</a>
        <div class="dropdown">
          <a class="nav-item nav-link" href="#">About</a>
          <div class="dropdown-content">
            <a href="#">Our story</a>
            <a href="#">Projects</a>
            <a href="#">Organisation</a>
          </div>
        </div>
        <a class="nav-item nav-link" href="../index-blog.php">Blog</a>
        <a class="nav-item nav-link" href="#">Contact</a>
        <a class="nav-item nav-link" href="00381631664071"><i class="fa fa-phone" aria-hidden="true"></i> +381 63 166 40 71</a>
      </div>
    </div>
  </div>
</nav>


<section class="hero-section">
    <div class="container-fluid">
        <div class="hero-image">
            <div class="hero-text">
              <h1 class="hero-header">Blog</h1>
              <p>inner and outer self-care</p>
            </div>
        </div>
    </div>
</section>

<section class="blog-section">
    <div class="container">
        <div class="row">
            <div id="newsResults" class="row"></div>
        </div>

        <div id="loader">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>

    </div>
</section>



<footer>
  <!-- Footer main -->
  <section class="ft-main">
   <div class="ft-main-item">
     <span>Need any help?</span>
      <h2 class="ft-title-main">Contact us. <br><span>Let's talk.</span></h2>
    </div> 
    <div class="ft-main-item">
      <h2 class="ft-title">Resource</h2>
      <ul class="footer-list">
        <li><a href="#">About Us</a></li>
        <li><a href="#">Technologies & Tool</a></li>
        <li><a href="#">Marketing design</a></li>
      </ul>
    </div>
    <div class="ft-main-item">
      <h2 class="ft-title">Where we are</h2>
      <ul class="footer-list">
        <li>Veljka Dugo??evi??a 54 
        <br>
        11050 Beograd
        <br>
        Serbia</li>
      </ul>
    </div>
    <div class="ft-main-item">
      <h2 class="ft-title">Our contact info</h2>
      <ul class="footer-list">
        <li><a href="mailto:info@asioso.com">info@asioso.com</a></li>
        <li><a href="tel:381631664071">+381 63 166 40 71</a></li>
      </ul>
    </div>
  </section>
  
</footer>
<!-- START JAVASCRIPT -->
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/css/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/blog.js"></script>
<!-- JAVASCRIPT END -->

</body>

</html>


</body>
</html>


<script>

$(document).ready(function () {

  let url = "https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=f53ef75b80f544369216f9f9c478f354";

  $.ajax({
    url: url,
    method: "GET",
    dataType: "JSON",

    beforeSend: function () {
      $(".progress").show();
    },

    complete: function () {
      $(".progress").hide();
    },

    success: function (newsdata) {
      let output = "";
      var parts = window.location.href.split('/');
      var lastSegment = parts.pop() || parts.pop();
      
      let latestNews = newsdata.articles;
      for (var i in latestNews) {
//          console.log(latestNews[i].author);
        if (lastSegment == latestNews[i].publishedAt) {
        output += `
          <div class="col-md-4 col-sm-12">
          <div class="card medium hoverable">
            <a href="../single-blog.php/${latestNews[i].publishedAt}" target="_blank">
            <div class="card-image">
                <img src="${latestNews[i].urlToImage}" class="img-fluid img-blog" alt="${latestNews[i].title}">
            </div>
            </a>
            <div class="card-content">
              <h4 class="truncate"> <a href="../single-blog.php/${latestNews[i].publishedAt}" title="${latestNews[i].title}">${latestNews[i].title}</a></h4>
            </div>
            <div class="card-info">
                  <p class="float-left"><i class="fa fa-user-o" aria-hidden="true"></i> ${latestNews[i].author} </p>
            </div>

            <div class="card-reveal">
              <p> ${latestNews[i].description}</p>
            </div>

            <div class="card-action">
              <a href="../single-blog.php/${latestNews[i].publishedAt}" target="_blank" class="btn">Read More</a>
            </div>
           </div>
          </div>
        `;
      }
      }

      if (output !== "") {
        $("#newsResults").html(output);
      }

    },

    error: function () {
      let errorMsg = `<div class="errorMsg center">Some error occured</div>`;
      $("#newsResults").html(errorMsg);
    }
  }) 
     

});

</script>