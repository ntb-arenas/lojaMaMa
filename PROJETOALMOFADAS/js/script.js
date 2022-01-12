const btn = document
    .querySelectorAll('.read-more-btn');

const text = document
    .querySelectorAll('.content-wrapper');

const contentWrapper = document
    .querySelectorAll('.content-wrapper');

for (var i = 0; i < contentWrapper.length; i++) {
    contentWrapper[i]
        .addEventListener('click', e => {
            const current = e.target;

            const isReadMoreBtn = current.className.includes('read-more-btn');

            if (!isReadMoreBtn)
                return;

            const currentText = e.target.parentNode.querySelector('.desc__read-more');

            currentText.classList.toggle('desc__read-more--open');

            current.textContent = current.textContent.includes('Ler mais') ? 'Ler menos' : 'Ler mais';
        });
}


$(document).ready(function () {
    $('.autoWidth').lightSlider({
        autoWidth: true,
        loop: true,
        onSliderLoad: function () {
            $('.autoWidth').removeClass('cS-hidden');
        }
    });
});

function myFunction() {
    // Get the checkbox
    var checkBox = document.getElementById("myCheck");
    // Get the output text
    var text = document.getElementById("text");
  
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
      text.style.display = "none";
    }
  }