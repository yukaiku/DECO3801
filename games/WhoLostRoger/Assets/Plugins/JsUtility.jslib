mergeInto(LibraryManager.library, {

  CloseTabJS: function () {
    window.close();
  },

  BackTabJS: function () {
    window.history.back();
  },

  SendDataJS: function (url, fields) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log("status code 4 or 200");
      };
      xhttp.open("POST", "" + url, true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("" + fields);
    }
  },
});
