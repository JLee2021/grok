import template from './haul-end.html?raw'
/*Haul End
Input: End Date, End GPS;
Btn: End Haul
*/
function setupHaulEnd(el) {
  el.innerHTML = template

  // Update Species & Dispostion Lists
  // el.querySelector('#list-species').innerHTML = listSpecies()
  // el.querySelector('#list-dispo').innerHTML = listDispo()
}

export {
  setupHaulEnd
}
