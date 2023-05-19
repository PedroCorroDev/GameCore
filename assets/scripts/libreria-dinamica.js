const sliderGames = [];

sliderGames[0] = 'https://www.pcspecialist.es/images/landing/pcs/gaming-pc/bundle.jpg';
sliderGames[1] = 'https://www.zonatech.es/wp-content/uploads/2021/01/Nintendo-Switch-0-yasin-hasan-PU1uYnZrAL0-unsplash-scaled.jpg';
sliderGames[2] = 'https://www.notebookcheck.org/fileadmin/Notebooks/News/_nc3/black_ps5.png';
sliderGames[3] = 'https://cdn.computerhoy.com/sites/navi.axelspringer.es/public/media/image/2017/11/270087-prueba-xbox-one-x-consola-mas-potente-4k-hdr.jpg';

let currentSlide = 0;
let intervalId;

window.addEventListener('load', () => {
  document.getElementById('sliderGames').style.backgroundImage = "url(" + sliderGames[currentSlide] + ")";

  for (let i = 0; i < sliderGames.length; i++) {
    let iExtra = document.createElement('i');
    iExtra.className = "circle";
    iExtra.id = "circle" + i;
    if (iExtra.id == "circle0") {
      iExtra.className = "circleFocus";
    }
    document.getElementById('circleSlider').appendChild(iExtra);
    document.getElementById('circle' + i).addEventListener("click", goToGame);
  }

  startInterval();

  function startInterval() {
    intervalId = setInterval(() => {
      currentSlide = (currentSlide + 1) % sliderGames.length;
      document.getElementById('sliderGames').style.backgroundImage = "url(" + sliderGames[currentSlide] + ")";
      updateCircleFocus();
    }, 3000);
  }

  function stopInterval() {
    clearInterval(intervalId);
  }

  function updateCircleFocus() {
    for (let j = 0; j < sliderGames.length; j++) {
      if (j == currentSlide) {
        document.getElementById('circle' + j).className = "circleFocus";
      } else {
        document.getElementById('circle' + j).className = "circle";
      }
    }
  }

  function goToGame(e) {
    stopInterval();
    currentSlide = parseInt(e.target.id.replace(/[^0-9\.]/g, ''));
    document.getElementById('sliderGames').style.backgroundImage = "url(" + sliderGames[currentSlide] + ")";
    updateCircleFocus();
    startInterval();
  }
});