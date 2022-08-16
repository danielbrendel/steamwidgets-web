/**
 * app.js
 * 
 * Put here your application specific JavaScript implementations
 */

 window.vue = new Vue({
    el: '#app',

    data: {
    },

    methods: {
        initNavBar: function() {
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            if ($navbarBurgers.length > 0) {
                $navbarBurgers.forEach( el => {
                    el.addEventListener('click', () => {
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);

                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');
                    });
                });
            }
        },
    }
});

import hljs from 'highlight.js';
import 'highlight.js/scss/github.scss';

window.hljs = hljs;

document.addEventListener('DOMContentLoaded', function(){
    window.hljs.highlightAll();
 });