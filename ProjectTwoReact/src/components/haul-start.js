/*Start Haul
Input: Start Date, Start GPS;
Btn: Start Haul
*/
import template from './haul-start.html?raw'

function setupHaulStart(el) {
  el.innerHTML = template

  // Update Species & Dispostion Lists
  // el.querySelector('#list-species').innerHTML = listSpecies()
  // el.querySelector('#list-dispo').innerHTML = listDispo()
}

export {
  setupHaulStart
}
