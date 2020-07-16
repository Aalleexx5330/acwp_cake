(function () {
    "use strict";
    let target = document.querySelectorAll('a[href^="#"]');
    let i = 0;
    for (i=0; i<target.length; i++) {
       target[i].onclick = function (e) {
          let hash = this.getAttribute("href");
          let elem = document.getElementById(hash.replace("#",""));
          //history.pushState (null, null, hash);
          elem.scrollIntoView({ left: 0, block: 'start', behavior: 'smooth' });
          e.preventDefault();
        }
    }
  })();