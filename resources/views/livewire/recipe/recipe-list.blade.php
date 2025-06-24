<div x-data>
  <button @click="$store.recipeCrud.openModal()" class="bg-green-500 text-white py-2 px-4 rounded mt-4">
    Add New Recipe
  </button>

  <div x-show="$store.recipeCrud.recipes.length === 0" class="mt-4 text-gray-500">Loading...</div>

  <table class="min-w-full bg-white border border-gray-300 mt-4">
    <thead>
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Name</th>
        <th>Servings</th>
        <th>Prep Time</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <template x-for="(r, i) in $store.recipeCrud.recipes" :key="r.id">
        <tr>
          <td x-text="i + 1"></td>
          <td><img :src="r.image" class="w-16 h-16 object-cover rounded" /></td>
          <td x-text="r.name"></td>
          <td x-text="r.servings"></td>
          <td x-text="r.prepTimeMinutes + ' min'"></td>
          <td>
            <button @click="$store.recipeCrud.openModal(r)" class="text-blue-500">View/Edit</button>
            <button @click="$store.recipeCrud.deleteRecipe(r.id)" class="text-red-500">Delete</button>
          </td>
        </tr>
      </template>
    </tbody>
  </table>

  <template x-if="$store.recipeCrud.showModal">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-99">
      <div class="bg-white p-6 rounded w-3/4 max-h-screen overflow-y-auto">
        <h2 class="text-xl mb-4" x-text="$store.recipeCrud.currentRecipe ? 'Edit Recipe' : 'Add New Recipe'"></h2>

        <label>Name</label>
        <input x-model="$store.recipeCrud.newRecipe.name" class="w-full border p-2 mb-2" />

        <label>Servings</label>
        <input type="number" x-model="$store.recipeCrud.newRecipe.servings" class="w-full border p-2 mb-2" />

        <label>Prep Time (minutes)</label>
        <input type="number" x-model="$store.recipeCrud.newRecipe.prepTimeMinutes" class="w-full border p-2 mb-2" />

        <label>Image URL</label>
        <input x-model="$store.recipeCrud.newRecipe.image" class="w-full border p-2 mb-2" />

        <label>Instructions (one per line)</label>
        <textarea x-model="$store.recipeCrud.newRecipe.instructionsText" class="w-full border p-2 mb-2"></textarea>

        <div class="flex justify-end">
          <button @click="$store.recipeCrud.saveRecipe()"
            class="bg-blue-500 text-white py-2 px-4 rounded mr-2">Save</button>
          <button @click="$store.recipeCrud.closeModal()"
            class="bg-gray-500 text-white py-2 px-4 rounded">Cancel</button>
        </div>
      </div>
    </div>
  </template>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.store('recipeCrud', {
      recipes: [],
      currentRecipe: null,
      showModal: false,

      newRecipeFormInit: {
        name: '',
        servings: 1,
        prepTimeMinutes: 0,
        image: '',
        instructionsText: ''
      },
      newRecipe: {},

      init() {
        this.resetNew();
        this.fetchRecipes();
      },

      async fetchRecipes() {
        try {
          const res = await axios.get('https://dummyjson.com/recipes?limit=30');
          this.recipes = res.data.recipes;
        } catch (e) {
          console.error(e)
        }
      },

      openModal(r = null) {
        this.showModal = true;
        if (r) {
          this.currentRecipe = r;
          this.newRecipe = {
            ...r,
            instructionsText: r.instructions.join('\n')
          };
        } else {
          this.currentRecipe = null;
          this.resetNew();
        }
      },

      closeModal() {
        this.showModal = false;
        this.currentRecipe = null;
        this.resetNew();
      },

      resetNew() {
        this.newRecipe = {
          ...this.newRecipeFormInit
        };
      },

      async saveRecipe() {
        const data = {
          ...this.newRecipe,
          instructions: this.newRecipe.instructionsText.split('\n').filter(l => l)
        };

        if (this.currentRecipe) {
          // simulate update
          this.recipes = this.recipes.map(r => r.id === data.id ? data : r);
        } else {
          // simulate create (assign fake id)
          data.id = Date.now();
          this.recipes.push(data);
        }

        this.closeModal();
      },

      deleteRecipe(id) {
        if (!confirm('Delete this recipe?')) return;
        this.recipes = this.recipes.filter(r => r.id !== id);
      }
    });
  });
</script>
