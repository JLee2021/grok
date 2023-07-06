import { HaulModel } from '../model/haul.js'
import { HaulStore } from '../store/haul.js'

const store = new HaulStore()

export class HaulCtrl {
	getModel(parentId) { return new HaulModel(this.getStore(parentId)) }

  getStore(parentId) { return new HaulStore(parentId) }
}
