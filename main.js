function myFunction() {
    var toPageHtmlElement = document.querySelector(".toPage");
    if (toPageHtmlElement.style.display === "block") {
      toPageHtmlElement.style.display = "none";
    } else {
      toPageHtmlElement.style.display = "block";
    }
  }
