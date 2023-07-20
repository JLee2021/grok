/*
  List Vessels
  List: Vessels -> trip-list.js
   - vessel-list
*/
import template from "./vessel-list.html?raw";
import { VesselCtrl } from "../controller/vessel";
import { render, watch } from "../app-lib";

import { setupAppCrumbs } from "./app-crumbs";

// vesselApi.get();

// Setup
const ctrl = new VesselCtrl()
async function setupVesselList(props) {
  const store = ctrl.getStore()
  const ref = await store.getRef();
  const vessels = await store.getMany()

  return {
    template,
    onAfter: (el) => {
      watch(ref, (n, o) => setupVesselList(props), { id: 'vesselList' });

      // Update the appCrumbs until after the login page.
      render(setupAppCrumbs({ reset: true }), { id: false })

      // Add Actions
      el.querySelector("#vessel-list").innerHTML = listVessels(
        vessels.value || []
      );
    }
  }
}

// Fragments
function listVessels(items) {
  return items.map((item) => /*html*/ `
    <tr>
      <th scope="row">
        <a class="vessel" href="/vessel/${item.vpNo}" data-navigo>
          ${item.name}
        </a>
      </th>
      <td data-sort-value="3">
        ${item.vpNo}
      </td>
    </tr>
  `).join("")
}

export { setupVesselList };
