import './bootstrap';
import "flyonui/flyonui"

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const alert = document.querySelector('.alertOriginal');
const filter = document.querySelector('#filter');
const filterContainer = document.querySelector('#filter-container');
const reset = document.querySelector('#reset');
const checkboxes = document.querySelectorAll('.checkbox');
const destroy = document.querySelector('#destroy');
const pagination = document.querySelector('.pagination');
const selected = [];

reset.addEventListener('click', () => {
  document.querySelector('#search').value = '';
  document.querySelector('#client').value = '';
  document.querySelector('#counter').value = '';
  document.querySelector('#status').value = '';
  checkboxes.forEach(checkbox => {
    checkbox.checked = false;
  });
});

checkboxes.forEach(checkbox => {
  checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
        selected.push(checkbox.value)
    } else {
        selected.splice(selected.indexOf(checkbox.value), 1)
    }
  });
})

pagination.addEventListener('click', () => {
  checkboxes.forEach(checkbox => {
    checkbox.checked = false;

    setTimeout(() => {
      if(selected.includes(checkbox.value)) {
        checkbox.checked = true;
    }
    },700)
  })  
})

destroy.addEventListener('click', () => {
  checkboxes.forEach(checkbox => {
    checkbox.checked = false;
  })
})

filter.addEventListener('click', () => {
  filterContainer.classList.toggle('hidden');
});

if(alert) {
  setTimeout(() => {
    alert.remove();
  }, 3000);   
}
