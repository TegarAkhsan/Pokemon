let text = document.getElementById('text');
let cloud1 = document.getElementById('cloud1');
let cloud2 = document.getElementById('cloud2');
let mountain1 = document.getElementById('mountain1');
let mountain2 = document.getElementById('mountain2');
let mountain3 = document.getElementById('mountain3');
let mountain4 = document.getElementById('mountain4');
let bird = document.getElementById('bird');

window.addEventListener('scroll', () => {
    let value = window.scrollY;

    text.style.marginTop = value * 2.5 + 'px';

    cloud1.style.left = value * 2.5 + 'px';
    cloud2.style.left = value * -2.5 + 'px';

    mountain1.style.top = value * 0.8 + 'px';
    mountain2.style.left = value * -1 + 'px';
    mountain3.style.left = value * 1 + 'px';
    mountain4.style.top = value * 1.5 + 'px';

    bird.style.top = value * -1 + 'px';
    bird.style.left = value * -1 + 'px';

});



