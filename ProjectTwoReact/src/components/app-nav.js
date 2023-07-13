import template from './app-nav.html?raw'

// Setup: Setup a compnent, Load it to the provided el.
async function setupAppNav(props = { prop: 'default' }) {

  return {
    template,
    onAfter: (el) => {
      console.info(' - Update AppNav List')
      // Do Something with el; el is the location of template in the DOM.
    }
  }

}


export {
  setupAppNav
}
