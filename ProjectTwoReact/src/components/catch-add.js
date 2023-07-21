import { router } from '../main'
import { CatchStore } from '../store/catch'


/*
 * Add Catch
 * Select: Species Name, Disposition Code;
 * Btn: Add Catch
 *
 * Elment IDs: list-species, list-dispo
*/

async function setupCatchAdd(props = { id: null, vpNo: null, tripId: null }) {
  const haulId = props.id
  const vpNo = props.vpNo
  const tripId = props.tripId

  console.log('Setting Catch for Haul: %o', haulId)
  // const store = new CatchStore({ vpNo, tripId, haulId })

  return {
    template: /*html*/ `
<div class="margin-3">
  <form class="usa-form" id="grok_form_login" method="" action="">
    <fieldset class="usa-fieldset">
      <legend class="usa-legend usa-legend--large">Add Catch</legend>

      <label class="usa-label" for="list-species">
        Species Name
      </label>
      <select class="usa-select" id="list-species" title="Species" name="list-species">
        ${listSpecies()}
      </select>

      <label class="usa-label" for="list-dispo">Disposition Code</label>
      <select class="usa-select" id="list-dispo" name="list-dispo">
        ${listDispo()}
      </select>

      <input id="add-catch" class="usa-button" type="submit" name="add-catch" value="Add Catch" />
    </fieldset>
  </form>

  <div id="map" class="margin-3"></div>
  </div>
</div>
    `,
    onAfter: (el) => {
      document.querySelector('#add-catch')
        .addEventListener('click', (e) => addCatch(e, { vpNo, tripId, haulId }))
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
async function addCatch(e, obj) {
  e.preventDefault()
  obj.specName = document.querySelector('#list-species').value || 'unk'
  obj.dispCode = document.querySelector('#list-dispo').value || '4'

  const store = new CatchStore(obj)
  obj = await store.addOne(obj)
  const {vpNo, tripId, haulId} = obj
  router.navigate(`/catch?vpNo=${vpNo}&tripId=${tripId}&haulId=${haulId}`)
}


export {
  setupCatchAdd
}
