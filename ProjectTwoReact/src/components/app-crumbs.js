// const _props = {
//   vpNo: null,
//   tripId: null,
//   msg: null
// }

// Setup: Setup a compnent, Load it to the provided el.
async function setupAppCrumbs(props = { vpNo: null, tripId: null, msg: null, reset: false }) {

/*
  // Vessel List, [VpNo], [ Trips || Hauls || Catch]
  Vessel / Trip / [Haul || Catch]
    - bread-vsl-list, bread-vpno, bread-page
*/
  return {
    template: /*HTML*/ `
<div class="grid-container">
  <nav class="usa-breadcrumb" aria-label="Breadcrumbs,,">
    <ol id="bread-all" class="usa-breadcrumb__list">
    </ol>
  </nav>
</div>
    `,
    onAfter: (el, template) => {
      // Default to rendering this component at #app-crumbs.
      if (! el) {
        el = document.getElementById('app-crumbs')
        el.innerHTML = template
      }


      el.querySelector('#bread-all').innerHTML = /*html*/`
        ${showVpNo(props)}
        ${showTripId(props)}
        ${showPage(props)}
      `
    }
  }
}

function showVpNo(props) {
  if (! props.vpNo) { return '' }
  return /*html*/`
    <li class="usa-breadcrumb__list-item">
      <a href="/vessel/${props.vpNo}" class="usa-breadcrumb__link" data-navigo>
        <span id="bread-vpno">Vessel</span>
      </a>
    </li>
  `
}

function showTripId(props) {
  if (! props.tripId) { return '' }
  return /*html*/`
    <li class="usa-breadcrumb__list-item">
      <a href="/trip/${props.tripId}?vpNo=${props.vpNo}"
        class="usa-breadcrumb__link"
        data-navigo
      >
        <span id="bread-vpno">Trip</span>
      </a>
    </li>
  `
}

function showPage(props) {
  if (! props.msg) { return '' }
  return /*html*/ `
    <li class="usa-breadcrumb__list-item usa-current" aria-current="page">
      <span id="bread-page">
        ${props.msg}
      </span>
    </li>
  `
}

export {
  setupAppCrumbs
}
