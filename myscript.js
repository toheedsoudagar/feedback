document.addEventListener("DOMContentLoaded", function() {
    var feedbackItems = document.querySelectorAll(".feedback-item");
  
    function fadeInFeedback() {
      feedbackItems.forEach(function(item, index) {
        setTimeout(function() {
          item.classList.add("fade-in");
        }, index * 200);
      });
    }
  
    fadeInFeedback();
  });
  