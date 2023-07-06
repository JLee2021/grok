import template from './catch-list.html?raw'
import { CatchCtrl } from '../controller/catch'
import { watch } from '../app-lib'

import { setupCatchAdd } from './catch-add'
import { setupAppCrumbs } from './app-crumbs'

/*
List Catch
Btn: Add Catch;
List: speciesName+speciesCode;
*/
const ctrl = new CatchCtrl()
async function setupCatchList(el, { haulId = null } = { haulId: null }) {
  console.log('Setup CatchList: %o', haulId)
  const store = ctrl.getStore(haulId)

  // Update Component
  async function update() {
    const catches = await store.getMany()
    el.innerHTML = template

    // Actions
    el.querySelector('#catch-list').innerHTML = listCatches(catches || [])
    // el.querySelector('#catch-list').addEventListener('click', (e) => toHaulList(e))
    el.querySelector('#add-catch').addEventListener('click', () => toCatchAdd(haulId))
  }

  const storeRef = await store.getRef()
  watch(storeRef, (n, o) => update(), { id: 'catchList'})
  update()

  // Update Species & Dispostion Lists
  // el.querySelector('#list-species').innerHTML = listSpecies()
  // el.querySelector('#list-dispo').innerHTML = listDispo()
}

function listCatches(items) {
  setupAppCrumbs(null, { msg: 'We Caught!' })

  console.log('listing catches: %o', items)
  const catchId = (item) => `${item.haulId}-${item.id}`

  return `
    <di>
      <li>Species | Count </li>
      ${items.map((item) => `
        <li>
          ${item.specName} | ${item.dispCode}
        </li>
      `).join("")}
    </di>
  `;
}
function toCatchAdd(haulId) {
  setupCatchAdd(document.querySelector("#main-content"), { haulId })
}

export {
  setupCatchList
}
