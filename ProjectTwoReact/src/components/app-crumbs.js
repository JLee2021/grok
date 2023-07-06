import template from './app-crumbs.html?raw'
import { setupTripList } from './trip-list'
import { setupVesselList } from './vessel-list'

const props = {
  vpNo: null,
  msg: null
}

// Setup: Setup a compnent, Load it to the provided el.
async function setupAppCrumbs(el, { vpNo = null, msg = null } = { vpNo: null, msg: null } ) {
  // Default to #app-crumbs entry point.
  if (! el) {
    el = document.querySelector('#app-crumbs')
  }

  console.info('Do something with passed in property: $prop')
  props.vpNo = vpNo ? vpNo :props.vpNo
  props.msg = msg ? msg :props.msg

  // Update Component
  async function update(el) {
    console.info('Update AppCrumbs List: vpNo, msg: %o, %o', props.vpNo, props.msg)
    el.innerHTML = template

    // Vessel List, [VpNo], [ Trips || Hauls || Catch]
    //  - bread-vsl-list, bread-vpno, bread-page
    document.querySelector('#bread-all').innerHTML = /*html*/`
      <li class="usa-breadcrumb__list-item">
        <a href="" id="bread-vsl-list" class="usa-breadcrumb__link">
          <span>Vessel List</span>
        </a>
      </li>
      ${showVpNo(props.vpNo)}
      ${showPage(props.msg)}
    `

    // Add Actions
    // el.querySelector('#bread-vpno').innerHTML = props.vpNo
    // el.querySelector('#bread-page').innerHTML = props.msg
    el.querySelector('#bread-vsl-list').addEventListener('click', toVesselList)
    if (props.vpNo) {
      el.querySelector('#bread-vpno').addEventListener('click', toTripList)
    }
  }

  // watch($ref, (n, o) => update(el))
  update(el)
}

function showVpNo(vpNo) {
  if (! vpNo) { return '' }
  return /*html*/`
    <li class="usa-breadcrumb__list-item">
      <a href="" class="usa-breadcrumb__link">
        <span id="bread-vpno" data-id="vpno">
          ${props.vpNo}
        </span>
      </a>
    </li>
  `
}

function showPage(msg) {
  if (! msg) { return '' }
  return /*html*/ `
    <li class="usa-breadcrumb__list-item usa-current" aria-current="page">
      <span id="bread-page">
        ${msg}
      </span>
    </li>
  `
}

function toVesselList(e) {
  e.preventDefault()
  setupVesselList(document.querySelector("#main-content"))
}

function toTripList(e) {
  e.preventDefault()
  setupTripList(document.querySelector("#main-content"), { vpNo: props.vpNo })
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
// function toAppCrumbsOther() {
//   setupAppCrumbsOther(document.querySelector('#main-content'))
// }


export {
  setupAppCrumbs
}
