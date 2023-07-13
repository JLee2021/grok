import template from './catch-add.html?raw'
import { watch } from '../app-lib'
import { CatchCtrl } from '../controller/catch'
import { router } from '../main'


/*
 * Add Catch
 * Select: Species Name, Disposition Code;
 * Btn: Add Catch
 *
 * Elment IDs: list-species, list-dispo
*/

const ctrl = new CatchCtrl()
async function setupCatchAdd(props = { haulId: null }) {
  const haulId = props.haulId
  console.log('Setting Catch for Haul: %o', haulId)
  const store = ctrl.getStore(haulId)

  return {
    template,
    onAfter: (el) => {
      document.querySelector('#add-catch').addEventListener('click', (e) => addCatch(e, haulId))

      // Update Species & Dispostion Lists
      el.querySelector('#list-species').innerHTML = listSpecies()
      el.querySelector('#list-dispo').innerHTML = listDispo()
    }
  }

}

// Fragments
function listSpecies() {
  return /*html*/`
    <option value>- Select -</option>
    <option>Rainbow</option>
    <option>Dolly</option>
    <option>Sea Bass</option>
  `
}

function listDispo() {
  return /*html*/`
    <option value>- Select -</option>
    <option>Dispostion-1b</option>
    <option>Dispostion-2b</option>
    <option>Dispostion-3b</option>
  `
}

// Actions
async function addCatch(e, haulId) {
  e.preventDefault()
  const specName = document.querySelector('#list-species').value || 'unk'
  const dispCode = document.querySelector('#list-dispo').value || '4'

  // ToDo: Could be store.addOne(...)
  await ctrl.getStore(haulId).addOne({ haulId, specName, dispCode })
  router.navigate(`/catch/${haulId}`)
}


export {
  setupCatchAdd
}
