import { router } from "./main";

/* Create a custom proxy object used for (watch)ing object changes.
 *
 * @param {object} obj  an object, array, or function: see MDN proxy API.
 * @param {function} callback  an optional update function when obj changes.
 * @return ref object  An object with a target and value parameter.
 */
export function ref(obj, callback = null) {
  let intercepts = {}
  if (typeof callback === 'function' ) {
    intercepts = {
      set(target, prop, val, ref) {
        callback(val, ref[prop] || null);
        target[prop] = val
        return true
      }
    }
  }

	return { target: obj, value: new Proxy(obj, intercepts) }
}

/* Watch for changes in a custom proxy (ref) object.  When ref.value is modified.
 *
 * Low level details: Intercepts the "set" action and runs a callback.
 * Nests the passed in value property (proxy) inside another proxy.
 *
 * @param {object} ref  a reference object: see ref function; value prop is a Proxy.
 * @param {function} callback  the function to call when "set" action is intercepted.
 *
 */
export function watch(ref, callback, { id }) {
	// Organize proxy's by a component ID.
  console.info(' - Set Watcher: %o', id)
  ! ref.components ? ref.components = []: undefined
  ref.components[id] = new Proxy(ref.target, {
		set(target, prop, val, ref) {
			callback(val, ref[prop] || null)
			target[prop] = val
			return true
		}
  })

  // Return Proxy by ID.
  return ref.components[id]
}

// export async function renderToDom(elId = 'main-content', component, props) {
export async function render(context, options = { id: null }) {
  // Default to add template to DOM: skip, #main-content, passed in id.
  const id = (options.id === false) ? 'skip'
    : options.id === null ? 'main-content'
      : options.id
  console.info(' - Rendering in: #%s', id)

  context.then(ctx => {
    /* Every component should return a context object with at least a
      template to load into the DOM.

      Example context object returned by a setupComponet: {
        template: '<h1> this is a component </h1>',
        onAfter: (el) => {
          // run some sideaffects after the template is loaded to the DOM.
        }
      }

      # Hooks
      onAfter: The 'el' param is passed to the components onAfter hook if
      it exists. El is a reference to the components location in the DOM.
    */

    // Skip template injection...the component wants to do it.
    let el = null
    if (id !== 'skip') {
      el = document.getElementById(id)
      el.innerHTML = ctx.template
    }

    // Run code after setting the element template.
    if (ctx.onAfter) {
      // Pass the mounted el if there was one, and the template.
      ctx.onAfter(el, ctx?.template)
    }

    // Manually update all data-navigo anchor tags: Routing.
    router.updatePageLinks()

    return ctx
  })
}

/**
 * Get current date based on device datestamp.
 * Uses 24hr clock, GB time.
 *
 * Note: I prefer GB time also, but found this -> interesting. - https://technology.blog.gov.uk/2018/01/31/its-time-to-use-iso-8601-across-government/
 * @returns English date time stamp.
 */
export function getDateNow() {
  let date = new Date(); // based on device being correct

  const options = {
    year: "2-digit",
    month: "short",
    day: "2-digit",
    hour: "2-digit",
    minute: "numeric",
    second: "numeric",
  };

  return date.toLocaleDateString("en-GB", options); // I want dd mmm yy, hh:mm:ss (24hr clock, GB does it right)
}
