// JavaScript Document

   function fetch() {
        // GET SEARCH TERM
        var data = new FormData();
        data.append('search', document.getElementById("search").value);
        data.append('ajax', 1);
 
        // AJAX SEARCH REQUEST
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "search/searchDatabase.php", true);
        xhr.onload = function () {
          if (this.status==200) {
            var results = JSON.parse(this.response),
                wrapper = document.getElementById("results");
            wrapper.innerHTML = "";
            if (results.length > 0) {
              for(var res of results) {
                var line = document.createElement("div");
                line.innerHTML = res['prodname'] + " - " + res['quantity'] + " - " + res['location'];
                wrapper.appendChild(line);
              }
            } else {
              wrapper.innerHTML = "No results found :(";
            }
          } else {
            alert("ERROR LOADING FILE!");
          }
        };
        xhr.send(data);
        return false;
   }