import template from './app-nav.html?raw'

// Setup: Setup a compnent, Load it to the provided el.
async function setupAppNav(el, { $prop = 'default' } = { $prop: 'default' } ) {
  console.info('Do something with passed in property: $prop')

  // Update Component
  async function update(el) {
    console.info('Updat AppNav List')
    el.innerHTML = template

    // Add Actions
    // el.querySelector('#frag').innerHTML = $frag($ref.value || [])
    // el.querySelector('#action').addEventListener('click', toAppNavOther)
  }

  // watch($ref, (n, o) => update(el))
  update(el)
}



// Fragments: functions that return small sections of HTML.
// function $frag(items) {
//   return `
//     <di>
//       ${items.map(item => `<li>${item.name} - ${item.id}</li>`).join('')}
//     </di>
//   `
// }

// Actions: navigation, updating the store, none template stuff, etc.
// function toAppNavOther() {
//   setupAppNavOther(document.querySelector('#main-content'))
// }


export {
  setupAppNav
}
