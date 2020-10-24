/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// import './styles/app.css';
import './scss/style.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';
import 'popper.js';
import 'bootstrap';

require("./js/collection.js");

console.log('Hello Webpack Encore! Edit me in assets/app.js');

jQuery(function(){
    $('#collection-products').collection();
});

import { Calendar } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

// let calendar = new Calendar(calendarEl, {
//     plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
//     header : {
//         left: 'prev,next today',
//         left: 'prev,next today',
//         center: 'title',
//         right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
//     },
//     navLinks: true,
//     editable: false,
//     eventLimit: false,
//     events: [

//     ]
// });