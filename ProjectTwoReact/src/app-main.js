// USWDS images.
import imgClose from "@uswds/uswds/img/usa-icons/close.svg"
import imgSearchWhite from "@uswds/uswds/img/usa-icons-bg/search--white.svg"
//                             /uswds/img/usa-icons-bg/search--white.svg
// The following components make up the USA Header example.
// "usa-header"  index.js:navigation
// "usa-accordion"  index.js:accordion
// "usa-search"  index.js:search
import { navigation, search, accordion } from "@uswds/uswds/js"

// Setup: Setup a compnent, Load it to the provided el.
async function setupAppMain(props = { prop: 'default' }) {

  return {
    template,
    onAfter: (el) => {
      console.info(' - Main has loaded.')

      // Initializing USWDS Header Navigation.
      navigation.on(el)
      search.on(el)
      accordion.on(el)

      // ToDo: Forgot why this is here.
      document.getElementById("main-content").classList.add(
        'usa-layout-docs__main',
        'desktop:grid-col-9',
        'usa-prose',
        'usa-layout-docs'
      )

      // Routing does not close the nav bar; Force it closed.
      document.querySelector('.route-navigo').addEventListener('click', () => {
        const navClose = document.querySelector('.usa-nav__close')
        if (! navClose) {
          console.warn('.usa-nav__close not found.')
        }
        navClose?.click()
      })
    }
  }

}


const template = /*html*/ `
<!-- <script src="/uswds/js/uswds.min.js" type="module"></script> -->
<a class="usa-skipnav" href="#main-content">Skip to main content</a>

<!-- begin header exp -->
<div class="usa-overlay"></div>
<header class="usa-header usa-header--basic">
  <div class="usa-nav-container">
    <div class="usa-navbar">
      <div class="usa-logo">
        <em class="usa-logo__text"><a href="/" title="Project Atlas">Project Atlas</a></em>
      </div>

      <button type="button" class="usa-menu-btn">Menu</button>
    </div>

    <nav aria-label="Primary navigation" class="usa-nav">
      <button type="button" class="usa-nav__close">
        <img src="${ imgClose }" role="img" alt="Close" />
      </button>

      <ul class="usa-nav__primary usa-accordion">
        <li class="usa-nav__primary-item">
          <button type="button" class="usa-accordion__button usa-nav__link usa-current" aria-expanded="false"
            aria-controls="basic-nav-section-one">
            <span>&lt;Current section&gt;</span>
          </button>

          <ul id="basic-nav-section-one" class="usa-nav__submenu">
            <li class="usa-nav__submenu-item">
              <a href="javascript:void(0);"><span>&lt;Navigation link&gt;</span></a>
            </li>
            <li class="usa-nav__submenu-item">
              <a href="javascript:void(0);"><span>&lt;Navigation link&gt;</span></a>
            </li>
            <li class="usa-nav__submenu-item">
              <a href="javascript:void(0);"><span>&lt;Navigation link&gt;</span></a>
            </li>
            <li class="usa-nav__submenu-item">
              <a href="javascript:void(0);"><span>&lt;Navigation link&gt;</span></a>
            </li>
          </ul>
        </li>

        <li class="usa-nav__primary-item">
          <button type="button" class="usa-accordion__button usa-nav__link" aria-expanded="false"
            aria-controls="basic-nav-section-two">
            <span>Vessel</span>
          </button>

          <ul id="basic-nav-section-two" class="usa-nav__submenu">
            <li class="usa-nav__submenu-item">
              <a href="/vessel" class="route-navigo" data-navigo><span>Vessel List</span></a>
            </li>
            <li class="usa-nav__submenu-item">
              <a href="javascript:void(0);"><span>&lt;Navigation link&gt;</span></a>
            </li>
            <li class="usa-nav__submenu-item">
              <a href="javascript:void(0);"><span>&lt;Navigation link&gt;</span></a>
            </li>
          </ul>
        </li>

        <li class="usa-nav__primary-item">
          <a href="/" class="usa-nav-link" data-navigo><span>Logout</span></a>
        </li>
      </ul>

      <section aria-label="Search component">
        <form class="usa-search usa-search--small" role="search">
          <label class="usa-sr-only" for="search-field">Search</label>
          <input class="usa-input" id="search-field" type="search" name="search" />
          <button class="usa-button" type="submit">
            <img src="${ imgSearchWhite }" class="usa-search__submit-icon" alt="Search" />
          </button>
        </form>
      </section>
    </nav>
  </div>
</header>
<!-- end header exp -->


<div class="usa-section">
  <div class="grid-container">
    <div id="app">
      <div id="app-crumbs"></div>

      <main class="" id="main-content"></main>
    </div>
  </div>
</div>

` // End tmeplate

export {
  setupAppMain
}
