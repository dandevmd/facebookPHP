var errors = document.querySelectorAll(".error");
function hideErrors() {
  errors.forEach(function (error) {
    error.style.display = "none";
  });
}

setTimeout(hideErrors, 3000);
