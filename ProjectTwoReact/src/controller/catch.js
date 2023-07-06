import { CatchModel } from '../model/catch.js'
import { CatchStore } from '../store/catch.js'

export class CatchCtrl {
	getModel(parentId) { return new CatchModel(this.getStore(parentId)) }

  getStore(parentId) { return new CatchStore(parentId) }
}
