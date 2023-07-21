// import { HaulCtrl } from "../controller/haul";
import { render } from "../app-lib";
import { HaulStore } from "../store/haul";

import { setupAppCrumbs } from "./app-crumbs";

// Setup
async function setupHaulList(props = { tripId: null, vpNo: null }) {
  const tripId = props.tripId
  const vpNo = props.vpNo
  render(setupAppCrumbs({ tripId, vpNo, msg: 'Hauls' }), { id: false })

  const store = new HaulStore({vpNo, tripId})
  const hauls = await store.getMany()
  /*
    List Haul
    Btn: Add New Haul;
      - add-haul
    List: Hauls -> haul-start.js
      - haul-list
  */
  return {
    template: /*html*/ `
<div class="margin-3">
  <div class="usa-table-container--scrollable" tabindex="0">
    <table class="usa-table usa-table--striped">
      <caption>
        Haul List
      </caption>

      <thead>
        <tr>
          <th data-sortable scope="col" role="columnheader">Catch List</th>
          <th data-sortable scope="col" role="columnheader">GPS Start</th>
          <th data-sortable scope="col" role="columnheader">Start Date</th>
        </tr>
      </thead>

      <tbody id="haul-list">
        ${ listHauls(hauls) }
      </tbody>
    </table>
  </div>

  <div class="margin-3">
    <label for="add-haul">
      <a class="usa-button"
        href="/haul/start?vpNo=${vpNo}&tripId=${tripId}"
        id="add-haul"
        name="add-haul"
        data-navigo
      >Add Haul</a>
    </label>
  </div>
</div>
    `,
    onAfter: async (el) => {
      // Update Haul List
      // Note: Haul items could be rendered in the after hook.
      // const hauls = await store.getMany()
      // el.querySelector("#haul-list").innerHTML = listHauls(hauls);
    },
  }

}

// Fragments
function listHauls(items) {
  return items.map((item) => /*html*/ `
    <tr>
      <th scope="row" data-sort-value="3">
        <a class="usa-button usa-button usa-button--accent-warm"
          href="/haul/${item.id}?vpNo=${item.vpNo}&tripId=${item.tripId}"
          data-navigo
        >
          ${item.id}
        </a>
      </th>
      <td data-sort-value="3">${item.startGps}</td>
      <td data-sort-value="3">${item.startDate}</td>
    </tr>
  `).join('')
}

export { setupHaulList };
