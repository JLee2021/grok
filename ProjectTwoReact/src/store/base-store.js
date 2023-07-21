class Store {
  constructor() {
  }

  /**
   * Returns the next id from an array of objects indexed by prop: id.
   *
   * @param {} items  Items is an array of objects w/ an id property.
   * @returns {number}
   */
  nextId(items) {
    if (! items) {
      console.warn("nextId: items is not an array.")
      return 1
    }

    return 1 + items.reduce((pre, cur) => {
      const id = cur?.id?.replace
        ? cur?.id?.replace('-', '')
        : cur?.id

      return (pre < id)
        ? id
        : pre
    }, 0) // set pre to zero
  }

  /**
   * Add or update an item in an array of objects, where objects
   * have prop: id.  If item does not have an "id" prop, the nextId
   * is used to add a new item to contents.
   *
   * @param {*} item Item to update or Add.
   * @param {*} contents List of Items to update or append Item to.
   * @returns {array}
   */
  addUpdate(item, contents) {
    contents = ! contents ? [] :contents

    let index = -1
    if (item.id) {
      index = contents.findIndex((val) => val.id == item.id)
    } else {
      item.id = this.nextId(contents)
    }
    contents[index < 0 ? contents.length :index] = { ...item }
    return contents
  }

  /**
   * Update application memory.
   * @param {*} state
   * @param {*} contents
   */
  updateState(state, contents) {
    state.value.splice(...[0, state.value.length].concat(contents))
  }

}

export { Store }
