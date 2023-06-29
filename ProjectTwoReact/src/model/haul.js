export class HaulModel {
	constructor(store) {
		this.store = store;
	}

	// Get a vessel from memory.
	getHaul(id) {
		return this.store.getMany(id)
	}
}

