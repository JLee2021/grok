import template from './catch-list.html?raw'
/*
List Catch
Btn: Add Catch;
List: speciesName+speciesCode;
*/

function setupCatchList(el) {
  el.innerHTML = template

  // Update Species & Dispostion Lists
  // el.querySelector('#list-species').innerHTML = listSpecies()
  // el.querySelector('#list-dispo').innerHTML = listDispo()
}

export {
  setupCatchList
}
