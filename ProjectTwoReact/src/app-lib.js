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
export function watch(ref, callback) {
	// Wrap the current proxy with a new proxy and callback.
	ref.value = new Proxy(ref.target, {
		set(target, prop, val, ref) {
			callback(val, ref[prop] || null)
			target[prop] = val
			return true
		}
  })
}

