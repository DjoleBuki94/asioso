<?php include('layout/header.php') ?>

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



<?php include('layout/footer.php') ?>


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
      let latestNews = newsdata.articles;
      for (var i in latestNews) {
        output += `
          <div class="col-md-4 col-sm-12">
          <div class="card medium hoverable">
            <a href="single-blog.php/${latestNews[i].publishedAt}" target="_blank">
            <div class="card-image">
                <img src="${latestNews[i].urlToImage}" class="img-fluid img-blog" alt="${latestNews[i].title}">
            </div>
            </a>
            <div class="card-content">
              <h4 class="truncate"> <a href="single-blog.php/${latestNews[i].publishedAt}" title="${latestNews[i].title}">${latestNews[i].title}</a></h4>
            </div>
            <div class="card-info">
                  <p class="float-left"><i class="fa fa-user-o" aria-hidden="true"></i> ${latestNews[i].author} </p>
            </div>

            <div class="card-reveal">
              <p> ${latestNews[i].description}</p>
            </div>

            <div class="card-action">
              <a href="single-blog.php/${latestNews[i].publishedAt}" target="_blank" class="btn">Read More</a>
            </div>
           </div>
          </div>
        `;
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