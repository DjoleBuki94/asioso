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
        var m=0;
      let latestNews = newsdata.articles;
      for (var i in latestNews) {
          m=m+1;
          if(m<4){
        output += `
            <div class="col-md-4">
               <div class="blog-box">
                    <div class="">
                        <a href="single-blog.php/${latestNews[i].publishedAt}" class="btn-read-more">
                        <img src="${latestNews[i].urlToImage}" class="img-fluid blog-img-home" alt="${latestNews[i].title}">
                        </a>
                    </div>
                    <div class="blog-description">
                        <span class="news-date">
                            ${latestNews[i].publishedAt}
                        </span>
                        <div class="description-title">
                            <h3 class="news-title">
                                <a href="single-blog.php/${latestNews[i].publishedAt}" title="${latestNews[i].title}">${latestNews[i].title}</a>
                            </h3>
                        </div>
                        <a href="single-blog.php/${latestNews[i].publishedAt}" class="btn-read-more">Read More</a>
                    </div>
                </div>
            </div>
        `;
      }}

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

