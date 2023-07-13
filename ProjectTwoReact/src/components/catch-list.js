import template from './catch-list.html?raw'
import { CatchCtrl } from '../controller/catch'
import { render, watch } from '../app-lib'

import { setupAppCrumbs } from './app-crumbs'

/*
List Catch
Btn: Add Catch;
List: speciesName+speciesCode;
*/
const ctrl = new CatchCtrl()
async function setupCatchList(props = { haulId: null }) {
  const haulId = props.haulId
  const store = ctrl.getStore(haulId)
  const storeRef = await store.getRef()
  watch(storeRef, (n, o) => setupCatchList(), { id: 'catchList'})

  return {
    template,
    onAfter: async (el) => {
      const catches = await store.getMany()

      el.querySelector('#catch-list').innerHTML = listCatches(catches || [])
      el.querySelector('#add-catch').href = `/catch/${haulId}/add`
    }
  }
}

function listCatches(items) {

  render(setupAppCrumbs({ msg: 'We Caught!' }), { id: false })

  console.log('listing catches: %o', items)
  const catchId = (item) => `${item.haulId}-${item.id}`

  return items.map((item) => `
    <tr>
      <th>${item.specName}</th>
      <td>${item.dispCode}</td>
    </tr>
  `).join('');
}

export {
  setupCatchList
}
