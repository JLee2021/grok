/*
  This is an example component layout template.

	$name - component name; name of setup function, camelCase
  $html - html file for this components layout

  $ref - proxy reference var from store; reactive object or array
  $frag - example of inline func that builds and returns html fragments
  to$nameOther - nav example of loading another component (setupFunction)
*/

// Template & Supporting objects.
import template from "./vessel-list.html?raw";
// import { VesselCtrl } from "../controller/vessel";
import { render, watch } from "../app-lib";

// Components
import { setupAppCrumbs } from "./app-crumbs";

// const ctrl = new VesselCtrl()

// Setup a Component
async function setup$name(props = { someProperty: "default" }) {
  // Ideally this section of code would only be run once...

  // const store = ctrl.getStore()
  // const ref = await store.getRef();
  // const vessels = await store.getMany()

  // example: get proxy reference
  // watch($ref, (n, o) => setup$name(props), { id: 'A Unique Component ID'});

  // Return component context to the render function.
  return {
    template,
    onAfter: (el) => {
      // Example using render
      // Update the appCrumbs.
      render(setupAppCrumbs({ reset: true }), { id: false })

      // Update Fragments
      el.querySelector("#frag").innerHTML = $frag($ref.value || []);

      // Navigation is handled with navigo: router.navigate or <a href="route" data-navigo>

      // Control action from the user.
      el.querySelector("#action").addEventListener("click", (e) => {
        // Do some stuff...
        //  - get some data
        //  - update some data
        //  - Navigate somewhere
      });
    }
  }

}

// Fragments: functions that return small sections of HTML.
function $frag(items) {
  return /*html*/ `
    <div>
      <!-- Example Navigation: using navigo -->
      <a class="vessel" href="/vessel/${item.id}" data-navigo>
        ${item.name}
      </a>

      <ul>
        ${items.map((item) => `<li>${item.name} - ${item.id}</li>`).join("")}
      </ul>
    </div>
  `;
}

export { setup$name };
