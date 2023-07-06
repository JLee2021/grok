/*
  This is an example component layout template.

	$name - component name; name of setup function, camelCase
  $html - html file for this components layout

  $ref - proxy reference var from store; reactive object or array
  $frag - example of inline func that builds and returns html fragments
  to$nameOther - nav example of loading another component (setupFunction)
*/

import template from "./$html.html?raw";

// Setup: Setup a compnent, Loadit to the provided el.
async function setup$name(el, { $prop = "default" } = { $prop: "default" }) {
  console.info("Do something with passed in property: $prop");

  // example: get proxy reference
  const $ref = await new TripCtrl().getStore().getRef();

  // Update Component
  async function update(el) {
    console.info("Updating $name List");
    el.innerHTML = template;

    // Add Actions
    el.querySelector("#frag").innerHTML = $frag($ref.value || []);
    el.querySelector("#action").addEventListener("click", to$nameOther);
  }

  watch($ref, (n, o) => update(el), { id: 'A Unique Component ID'});
  update(el);
}

// Fragments: functions that return small sections of HTML.
function $frag(items) {
  return `
    <div>
      ${items.map((item) => `<li>${item.name} - ${item.id}</li>`).join("")}
    </div>
  `;
}

// Actions: navigation, updating the store, none template stuff, etc.
function to$nameOther() {
  setup$nameOther(document.querySelector("#main-content"));
}

export { setup$name };
