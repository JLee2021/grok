/*
  Vessel List, [VpNo], [ Trips || Hauls || Catch]
    - bread-vsl-list, bread-vpno, bread-page
*/

import template from './app-crumbs.html?raw'

const _props = {
  vpNo: null,
  msg: null
}

// Setup: Setup a compnent, Load it to the provided el.
async function setupAppCrumbs(props = { vpNo: null, msg: null, reset: false }) {

  return {
    template,
    onAfter: (el) => {
      // Default to rendering this component at #app-crumbs.
      if (! el) {
        el = document.getElementById('app-crumbs')
        el.innerHTML = template
      }

      if (props.reset) {
        _props.vpNo = null
        _props.msg = null
      } else {
        _props.vpNo = props.vpNo ? props.vpNo :_props.vpNo
        _props.msg = props.msg ? props.msg :_props.msg
      }

      el.querySelector('#bread-all').innerHTML = /*html*/`
        <li class="usa-breadcrumb__list-item">
          <a href="/vessels" id="bread-vsl-list" class="usa-breadcrumb__link" data-navigo>
            <span>Vessel List</span>
          </a>
        </li>
        ${showVpNo(props.vpNo)}
        ${showPage(props.msg)}
      `
    }
  }
}

function showVpNo(vpNo) {
  if (! vpNo) { return '' }
  return /*html*/`
    <li class="usa-breadcrumb__list-item">
      <a href="/trips/${vpNo}" class="usa-breadcrumb__link" data-navigo>
        <span id="bread-vpno">${vpNo}</span>
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

export {
  setupAppCrumbs
}
