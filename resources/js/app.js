/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';


/*const moment = require('moment-timezone');
//moment.tz.setDefault("America/New_York");
moment.tz.setDefault("Asia/Krasnoyarsk");
window.moment = moment;*/


// loads the Icon plugin
UIkit.use(Icons);

window.UIkit = UIkit;

import domtoimage from './domtoimgmy';
window.domtoimage = domtoimage;

require("print-js");

require("jquery.marquee");

require('./bootstrap');

require('./jquery.countdown.min.js');

require('./awesome.js');

require('./main.js');
