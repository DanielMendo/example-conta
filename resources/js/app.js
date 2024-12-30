import './bootstrap';
import "flyonui/flyonui"

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const alert = document.querySelector('.alertOriginal');

if(alert) {
  setTimeout(() => {
    alert.remove();
  }, 3000);   
}
