//Import Bootstrap File
import './bootstrap';

// Import our custom CSS
import '../sass/app.scss'

import Alpine from 'alpinejs';

window.Alpine = Alpine;


Alpine.data('dropdown', () => ({
  open: false,

  toggle() {
    this.open = !this.open;
  }
}));

Alpine.start()
