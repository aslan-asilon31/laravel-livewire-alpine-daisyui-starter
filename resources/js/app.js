import './bootstrap';

import './../../vendor/power-components/livewire-powergrid/dist/powergrid'

import Alpine from 'alpinejs';
import dropdown from './components/dropdown';



window.Alpine = Alpine;

Alpine.data('dropdown', dropdown);

Alpine.start();