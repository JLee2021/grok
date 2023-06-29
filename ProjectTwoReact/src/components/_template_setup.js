/*
  This is a tmeplate componet.
  $html - html file for this components layout
  $name - name of setup function, camelCase
  $ref - prxy reference var from store
  $frag - example of inline func that builds and returns html
  to$nameOther - example of loading another component (setupFunction)
*/

import template from './$html.html?raw'

function setup$name(el) {
  el.innerHTML = template

  // Update Sometehing
  el.querySelector('#thing-one').innerHTML = thingOne()
  el.querySelector('#thing-two').innerHTML = thingTwo()
}

// Setup
async function setup$name(el) {
  // example: get proxy reference
  const $ref = await (new TripCtrl()).getStore().getRef()

  // Update Component
  async function update(el) {
    console.info('Updateing $name List')
    el.innerHTML = template

    // Add Actions
    el.querySelector('#frag').innerHTML = $frag($ref.value || [])
    el.querySelector('#action').addEventListener('click', to$nameOther)
  }

  watch($ref, (n, o) => update(el))
  update(el)
}



// Fragments
function $frag(items) {
  return `
    <di>
      ${items.map(item => `<li>${item.name} - ${item.id}</li>`).join('')}
    </di>
  `
}

// Actions
function to$nameOther() {
  setup$nameOther(document.querySelector('#main'))
}


export {
  setup$name
}
