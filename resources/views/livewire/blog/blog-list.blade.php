<div>

  <!-- Alpine Component -->
  <div x-data="blogApp()" x-init="init()" class="p-6 space-y-6">


    <div x-data="dropdown">
      <button @click="toggle">Dropdown</button>
      <div x-show="open">open dropdown</div>
    </div>

    <h1 class="text-3xl font-bold">Blog Posts</h1>

    <button @click="openForm()" class="bg-green-500 text-white px-4 py-2 rounded">
      + Create Post
    </button>

    {{-- <input type="text" placeholder="Search posts..." x-model="search" class="border p-2 rounded w-full mb-4" /> --}}
    <input type="text" placeholder="Search posts..." x-model="search" @input="updateUrl()"
      class="border p-2 rounded w-full mb-4" />

    <!-- Form -->
    <div x-show="formOpen" class="bg-gray-100 p-4 rounded shadow-md space-y-4">
      <h2 x-text="currentPost ? 'Edit Post' : 'New Post'" class="text-xl font-semibold"></h2>
      <input type="text" x-model="form.title" placeholder="Title" class="w-full border p-2 rounded" />
      <textarea x-model="form.body" placeholder="Body" class="w-full border p-2 rounded"></textarea>
      <div class="flex gap-2">
        <button @click="savePost()" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
        <button @click="closeForm()" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
      </div>
    </div>

    <!-- Post List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <template x-for="post in posts.filter(p => p.title.toLowerCase().includes(search.toLowerCase()))"
        :key="post.id">

        <div class="border p-4 rounded space-y-2">
          <h3 class="text-lg font-semibold" x-text="post.title"></h3>
          <p x-text="post.body"></p>

          <div class="flex gap-2">
            <button @click="openForm(post)" class="text-blue-600">Edit</button>
            <button @click="deletePost(post.id)" class="text-red-600">Delete</button>
            <button @click="toggleComments(post.id)" class="text-gray-800">
              <span x-text="showingCommentsFor === post.id ? 'Hide' : 'Comments'"></span>
            </button>
          </div>

          <!-- Komentar -->
          <div x-show="showingCommentsFor === post.id" class="mt-4 border-t pt-2">
            <template x-for="c in comments[post.id] || []" :key="c.id">
              <div class="space-y-1 mb-2">
                <p class="font-semibold" x-text="c.name + ' (' + c.email + ')'"></p>
                <p x-text="c.body"></p>
              </div>
            </template>
            <div x-show="!(comments[post.id]?.length)">
              Loading comments...
            </div>
          </div>
        </div>
      </template>
    </div>

    <div x-show="!posts.length">Loading posts...</div>
  </div>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('blogApp', () => ({
        posts: [],
        comments: {},
        search: '',
        formOpen: false,
        currentPost: null,
        form: {
          title: '',
          body: ''
        },
        showingCommentsFor: null,

        init() {
          this.fetchPosts();
          this.setSearchFromUrl();
        },

        setSearchFromUrl() {
          const params = new URLSearchParams(window.location.search);
          if (params.has('search')) {
            this.search = params.get('search');
          }
        },

        updateUrl() {
          const url = new URL(window.location);
          if (this.search.trim() === '') {
            url.searchParams.delete('search');
          } else {
            url.searchParams.set('search', this.search);
          }
          window.history.replaceState({}, '', url);
        },


        async fetchPosts() {
          try {
            const {
              data
            } = await axios.get('https://jsonplaceholder.typicode.com/posts');
            this.posts = data;
          } catch (e) {
            console.error('Error load posts:', e);
          }
        },

        openForm(post = null) {
          this.currentPost = post;
          this.form = post ? {
            title: post.title,
            body: post.body
          } : {
            title: '',
            body: ''
          };
          this.formOpen = true;
        },

        closeForm() {
          this.formOpen = false;
          this.currentPost = null;
        },

        savePost() {
          if (!this.form.title || !this.form.body) {
            alert('Title and body required');
            return;
          }
          if (this.currentPost) {
            // Update lokal
            this.posts = this.posts.map(p =>
              p.id === this.currentPost.id ? {
                ...p,
                title: this.form.title,
                body: this.form.body
              } :
              p
            );
          } else {
            // Create lokal
            const newId = Math.max(...this.posts.map(p => p.id)) + 1;
            this.posts.unshift({
              id: newId,
              userId: 1,
              title: this.form.title,
              body: this.form.body,
            });
          }
          this.closeForm();
        },

        deletePost(id) {
          if (confirm('Delete this post?')) {
            this.posts = this.posts.filter(p => p.id !== id);
            if (this.showingCommentsFor === id) this.showingCommentsFor = null;
          }
        },

        async toggleComments(postId) {
          if (this.showingCommentsFor === postId) {
            this.showingCommentsFor = null;
            return;
          }
          this.showingCommentsFor = postId;
          if (!this.comments[postId]) {
            try {
              const {
                data
              } = await axios.get(
                `https://jsonplaceholder.typicode.com/comments?postId=${postId}`
              );
              this.comments[postId] = data;
            } catch (e) {
              console.error('Error load comments:', e);
              this.comments[postId] = [];
            }
          }
        },
      }))
    })
  </script>

</div>
