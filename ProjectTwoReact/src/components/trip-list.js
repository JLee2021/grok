/*Add Trip
Btn: Add New Trip;
List: Trip -> haul-list.js
*/
import template from "./trip-list.html?raw";
import { TripCtrl } from "../controller/trip";
import { tripApi } from "../service/trip-api";
import { render, watch } from "../app-lib";

import { setupAppCrumbs } from "./app-crumbs";
import { router } from "../main";

const ctrl = new TripCtrl();

// Setup
async function setupTripList(props = { vpNo: null }) {
  const vpNo = props.vpNo
  render(setupAppCrumbs({ vpNo, msg: "Trips" }), { id: false })
  const store = ctrl.getStore(vpNo);
  const storeRef = await store.getRef();
  watch(storeRef, (n, o) => setupTripList(props), { id: "tripList" });

  // Update Component
  return {
    template,
    onAfter: async (el) => {
      const trips = await store.getMany();

      // Add Actions
      el.querySelector("#trip-list").innerHTML = await listTrips(trips || []);
      el.querySelector("#start-trip").href = `/trips/${vpNo}/start`
      router.updatePageLinks()
    }
  }

}

// Fragments
function listTrips(items) {
  return items.map(item => /*html*/ `
    <tr>
      <th scope="row" data-sort-value="3">
        <a class="usa-button usa-button--accent-cool"
          href="/haul/${item.id}"
          data-navigo
        > ${item.id} </a>
      </th>
      <td>${item.obsId}</td>
    </tr>
  `).join('')
}

export { setupTripList };
