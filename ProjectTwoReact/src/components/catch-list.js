import { CatchCtrl } from '../controller/catch'
import { render } from '../app-lib'

import { setupAppCrumbs } from './app-crumbs'
import { CatchStore } from '../store/catch'

const ctrl = new CatchCtrl()
async function setupCatchList(props = {
  id: null, vpNo: null, tripId: null, haulId: null
}) {
  const vpNo = props.vpNo
  const tripId = props.tripId
  const haulId = props.haulId

  render(setupAppCrumbs({ vpNo, tripId, msg: `Haul (${haulId}) Catch` }), { id: false })

  const store = new CatchStore({ vpNo, tripId, haulId })
  const catchs = store.getMany()

  return {
    template: /*html*/ `
    <!--
  List Catch
  Btn: Add Catch;
   - add-catch
  List: speciesName+speciesCode;
   - catch-list
-->
<div class="margin-3">
  <div class="usa-table-container--scrollable" tabindex="0">
    <table class="usa-table usa-table--striped">
      <caption>
        Catch List
      </caption>
      <thead>
        <tr>
          <th data-sortable scope="col" role="columnheader">Species</th>
          <th data-sortable scope="col" role="columnheader">Count</th>
        </tr>
      </thead>
      <tbody id="catch-list">
      </tbody>
    </table>
  </div>

  <div class="margin-3">
    <label for="add-catch">
      <a id="add-catch"
        href="/catch/${haulId}/add?vpNo=${vpNo}&tripId=${tripId}&haulId=${haulId}"
        class="usa-button" data-navigo
      >Add Catch</a>
    </label>
  </div>
</div>
    `,
    onAfter: async (el) => {
      const catches = await store.getMany()

      el.querySelector('#catch-list').innerHTML = listCatches(catches || [])
    }
  }
}

function listCatches(items) {

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
