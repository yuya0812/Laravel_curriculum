

function like(postId) {
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: `/like/${postId}`,
      type: "POST",
    })
      .done(function (data, status, xhr) {
        $('#like-count').text(data.like_count + ' いいね');
        console.log(data)
      })
      .fail(function (xhr, status, error) {
        console.log()
      })
  }

function unlike(postId) {
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      url: `/unlike/${postId}`,
      type: "POST",
    })
      .done(function (data, status, xhr) {
        $('#like-count').text(data.like_count + ' いいね');
        console.log(data)
      })
      .fail(function (xhr, status, error) {
        console.log()
      })
  }

  function updateLikeCount(postId) {
    $.ajax({
        url: `/like-count/${postId}`,
        type: "GET",
        success: function (data) {
            // サーバーからのレスポンスでいいね数を更新
            $(`#like-count-${postId}`).text(data.likeCount + ' いいね');
        },
        error: function (xhr, status, error) {
            console.log('Error:', error);
        }
    });
}

  

  // console.log("動いてる？")