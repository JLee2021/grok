import template from './catch-add.html?raw'

/*
 * Add Catch
 * Select: Species Name, Disposition Code;
 * Btn: Add Catch
 *
 * Elment IDs: list-species, list-dispo
*/

function setupCatchAdd(el) {
  el.innerHTML = template

  // Update Species & Dispostion Lists
  el.querySelector('#list-species').innerHTML = listSpecies()
  el.querySelector('#list-dispo').innerHTML = listDispo()
}

function listSpecies() {
  return /*html*/`
    <option>Rainbow</option>
    <option>Dolly</option>
    <option>Sea Bass</option>
  `
}

function listDispo() {
  return /*html*/`
    <option>Dispostion-1b</option>
    <option>Dispostion-2b</option>
    <option>Dispostion-3b</option>
  `
}


export {
  setupCatchAdd
}
