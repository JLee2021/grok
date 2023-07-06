import template from './catch-add.html?raw'
import { watch } from '../app-lib'

import { setupCatchList } from './catch-list'
import { CatchCtrl } from '../controller/catch'


/*
 * Add Catch
 * Select: Species Name, Disposition Code;
 * Btn: Add Catch
 *
 * Elment IDs: list-species, list-dispo
*/

const ctrl = new CatchCtrl()
async function setupCatchAdd(el, { haulId = null } = { haulId: null }) {
  console.log('Setting Catch for Haul: %o', haulId)
  const store = ctrl.getStore(haulId)
  el.innerHTML = template;

  document.querySelector('#add-catch').addEventListener('click', (e) => addCatch(e, haulId))

  // Update Species & Dispostion Lists
  el.querySelector('#list-species').innerHTML = listSpecies()
  el.querySelector('#list-dispo').innerHTML = listDispo()
}

// Fragments
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

// Actions
async function addCatch(e, haulId) {
  const specName = document.querySelector('#list-species').value || 'unk'
  const dispCode = document.querySelector('#list-dispo').value || '4'

  await ctrl.getStore(haulId).addOne({ haulId, specName, dispCode })
  setupCatchList(document.querySelector('#main-content'), { haulId })
}



export {
  setupCatchAdd
}
