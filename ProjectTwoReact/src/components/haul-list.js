import template from "./haul-list.html?raw";
import { HaulCtrl } from "../controller/haul";
import { watch } from "../app-lib";

import { setupHaulStart } from "./haul-start";
import { setupCatchList } from "./catch-list";
import { setupAppCrumbs } from "./app-crumbs";

/*
  List Haul
  Btn: Add New Haul;
   - add-haul
  List: Hauls -> haul-start.js
   - haul-list
*/
const ctrl = new HaulCtrl()

// Setup
async function setupHaulList(el, { tripId = null} = { tripId: null }) {
  setupAppCrumbs(null, { msg: 'Hauls' })

  console.log('Setup HaulList: %o', tripId)
  const store = ctrl.getStore(tripId)

  // Update Component
  async function update() {
    const hauls = await store.getMany()
    // console.info("Updating Haul List: %o", tripId);
    el.innerHTML = template;

    // Update Trip List
    el.querySelector("#haul-list").innerHTML = listHauls(hauls);
    el.querySelector("#haul-list").addEventListener("click", toCatchList);
    el.querySelector("#add-haul").addEventListener("click", () => toStartHaul(tripId));
  }

  const storeRef = await store.getRef()
  watch(storeRef, (n, o) => update(), { id: 'haulList' });
  update();
}
const haulId = (item) => `${item.tripId}-${item.id}`

// Fragments
function listHauls(items) {
  console.log('listing haul items: %o', items)

  return items.map((item) => `
    <tr>
      <th scope="row" data-sort-value="3">
        <button
          class="usa-button usa-button usa-button--accent-warm"
          data-id="${haulId(item)}"
        >
          ${haulId(item)}
        </button>
      </th>
      <td data-sort-value="3">${item.startGps}</td>
      <td data-sort-value="3">${item.startDate}</td>
    </tr>`).join('')
}

// Actions
function toStartHaul(tripId) {
  setupHaulStart(document.querySelector("#main-content"), { tripId });
}
function toCatchList(e) {
  const haulId = e.target.dataset.id
  setupCatchList(document.querySelector("#main-content"), { haulId })
}

export { setupHaulList };
