import template from "./haul-list.html?raw";
import { HaulCtrl } from "../controller/haul";
import { render, watch } from "../app-lib";

import { setupAppCrumbs } from "./app-crumbs";
import { router } from "../main";

/*
  List Haul
  Btn: Add New Haul;
   - add-haul
  List: Hauls -> haul-start.js
   - haul-list
*/
const ctrl = new HaulCtrl()

// Setup
async function setupHaulList(props = { tripId: null }) {
  render(setupAppCrumbs({ msg: 'Hauls' }), { id: false })

  const tripId = props.tripId
  const store = ctrl.getStore(tripId)
  const storeRef = await store.getRef()
  watch(storeRef, (n, o) => update(), { id: 'haulList' });

  return {
    template,
    onAfter: async (el) => {
      const hauls = await store.getMany()

      // Update Trip List
      el.querySelector("#haul-list").innerHTML = listHauls(hauls);
      el.querySelector("#add-haul").href = `/haul/${tripId}/start`

      router.updatePageLinks()
    },
  }

}

const haulId = (item) => `${item.tripId}-${item.id}`

// Fragments
function listHauls(items) {
  return items.map((item) => /*html*/ `
    <tr>
      <th scope="row" data-sort-value="3">
        <a class="usa-button usa-button usa-button--accent-warm"
          href="/catch/${haulId(item)}"
          data-navigo
        >
          ${haulId(item)}
        </a>
      </th>
      <td data-sort-value="3">${item.startGps}</td>
      <td data-sort-value="3">${item.startDate}</td>
    </tr>
  `).join('')
}

export { setupHaulList };
