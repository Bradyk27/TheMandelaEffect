$(document).ready(function () {
    delete_cookie("cart_id");
    createCookie("cart_id", localStorage.getItem("cart").split(","), "10"); //fucking stupid ass cookie bullshit. why won't you post properly.
});

function createCookie(name, value, days) { //FROM https://stackoverflow.com/questions/1917576/how-do-i-pass-javascript-variables-to-php
    var expires;
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toGMTString();
    }
    else {
      expires = "";                                                                 //This is a hacky way of doing it...but for whatever reason I couldn't get Jquery POST to be received by PHP...so here's a hack.
    }
    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
  }

  function delete_cookie(name) { //FROM https://stackoverflow.com/questions/2144386/how-to-delete-a-cookie
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }