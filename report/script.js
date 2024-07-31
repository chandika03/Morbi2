document.getElementById("reportButton").addEventListener("click", function () {
  var userId = prompt("Enter the ID of the user you want to report:");
  var reportType = document.querySelector(
    'input[name="reportType"]:checked'
  ).value;

  // Send an AJAX request to the PHP script
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "report.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      alert(xhr.responseText);
    }
  };
  xhr.send("userId=" + userId + "&reportType=" + reportType);
});
