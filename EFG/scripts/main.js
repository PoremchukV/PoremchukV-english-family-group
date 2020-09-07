$("#frm_feedback").submit(function (e) {
  var string_msg = "";

  $.ajax({
    type: "POST",
    url: "../ajax/mail.php",
    beforeSend: function () {
      $("#submit").prop("disable", true);
    },
    cache: false,
    data: $("#frm_feedback").serializeArray(), // serializes the form's elements.
    success: function (data) {
      var data = jQuery.parseJSON(data);
      if (data.status) {
        alert(data.message);
      } else {
        string_msg = data.message.join("\n");
        alert(string_msg);
      }
    },
  });
  $("#frm_feedback").trigger("reset");
  e.preventDefault(); // avoid to execute the actual submit of the form.
});

$(function () {
  $('a[href^="#"]').on("click", function (event) {
    // отменяем стандартное действие
    event.preventDefault();
    var sc = $(this).attr("href"),
      dn = $(sc).offset().top;
    /*
     * sc - в переменную заносим информацию о том, к какому блоку надо перейти
     * dn - определяем положение блока на странице
     */
    $("html, body").animate({ scrollTop: dn }, 3000);
    /*
     * 1000 скорость перехода в миллисекундах
     */
  });
});
let didScroll = false;
let paralaxTitles = document.querySelectorAll(".paralax-title");

const scrollInProgress = () => {
  didScroll = true;
};

const raf = () => {
  if (didScroll) {
    paralaxTitles.forEach((element, index) => {
      element.style.transform = "translateX(" + window.scrollY / 10 + "%)";
    });
    didScroll = false;
  }
  requestAnimationFrame(raf);
};

requestAnimationFrame(raf);
window.addEventListener("scroll", scrollInProgress);

anime({
  targets: ".statistics__line .el",
  width: "100%", // -> from '28px' to '100%',
  easing: "easeInOutQuad",
  direction: "alternate",
  loop: true,
});
