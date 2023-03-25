/**
 * app.js
 * 
 * Put here your application specific JavaScript implementations
 */

import './../sass/app.scss';

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Chart from 'chart.js/auto';

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

                        if (el.classList.contains('is-active')) {
                            let rootel = document.getElementsByClassName('navbar')[0];
                            rootel.classList.add('navbar-purple');
                            rootel.classList.add('navbar-no-transition');
                        } else {
                            let rootel = document.getElementsByClassName('navbar')[0];
                            rootel.classList.remove('navbar-purple');
                            rootel.classList.remove('navbar-no-transition');
                        }
                    });
                });
            }
        },

        ajaxRequest: function (method, url, data = {}, successfunc = function(data){}, finalfunc = function(){}, config = {})
        {
            let func = window.axios.get;
            if (method == 'post') {
                func = window.axios.post;
            } else if (method == 'patch') {
                func = window.axios.patch;
            } else if (method == 'delete') {
                func = window.axios.delete;
            }

            func(url, data, config)
                .then(function(response){
                    successfunc(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .finally(function(){
                        finalfunc();
                    }
                );
        },

        renderStats: function(pw, elem, start, end = '') {
            window.vue.ajaxRequest('post', window.location.origin + '/stats/query/' + pw, { start: start, end: end }, function(response){
                if (response.code == 200) {
                    document.getElementById('inp-date-from').value = response.start;
                    document.getElementById('inp-date-till').value = response.end;
                    document.getElementById('count-total').innerHTML = response.count_total;
                    document.getElementById('count-app').innerHTML = response.counts.mod_app;
                    document.getElementById('count-server').innerHTML = response.counts.mod_server;
                    document.getElementById('count-user').innerHTML = response.counts.mod_user;
                    document.getElementById('count-workshop').innerHTML = response.counts.mod_workshop;
                    document.getElementById('count-group').innerHTML = response.counts.mod_group;
                    document.getElementById('referrers').innerHTML = '';

                    let content = document.getElementById(elem);
                    if (content) {
                        let labels = [];
                        let data_app = [];
                        let data_server = [];
                        let data_user = [];
                        let data_workshop = [];
                        let data_group = [];

                        let day = 60 * 60 * 24 * 1000;
                        let dt = new Date(Date.parse(start));

                        for (let i = 0; i <= response.day_diff; i++) {
                            let curDate = new Date(dt.getTime() + day * i);
                            let curDay = curDate.getDate();
                            let curMonth = curDate.getMonth() + 1;

                            if (curDay < 10) {
                                curDay = '0' + curDay;
                            }

                            if (curMonth < 10) {
                                curMonth = '0' + curMonth;
                            }

                            labels.push(curDate.getFullYear() + '-' + curMonth + '-' + curDay);
                            data_app.push(0);
                            data_server.push(0);
                            data_user.push(0);
                            data_workshop.push(0);
                            data_group.push(0);
                        }

                        for (const [key, value] of Object.entries(response.data.mod_app)) {
                            labels.forEach(function(lblElem, lblIndex){
                                if (lblElem == key) {
                                    data_app[lblIndex] = parseInt(value[0]);
                                }
                            });
                        }

                        for (const [key, value] of Object.entries(response.data.mod_server)) {
                            labels.forEach(function(lblElem, lblIndex){
                                if (lblElem == key) {
                                    data_server[lblIndex] = parseInt(value[0]);
                                }
                            });
                        }

                        for (const [key, value] of Object.entries(response.data.mod_user)) {
                            labels.forEach(function(lblElem, lblIndex){
                                if (lblElem == key) {
                                    data_user[lblIndex] = parseInt(value[0]);
                                }
                            });
                        }

                        for (const [key, value] of Object.entries(response.data.mod_workshop)) {
                            labels.forEach(function(lblElem, lblIndex){
                                if (lblElem == key) {
                                    data_workshop[lblIndex] = parseInt(value[0]);
                                }
                            });
                        }

                        for (const [key, value] of Object.entries(response.data.mod_group)) {
                            labels.forEach(function(lblElem, lblIndex){
                                if (lblElem == key) {
                                    data_group[lblIndex] = parseInt(value[0]);
                                }
                            });
                        }

                        const config = {
                            type: 'line',
                            data: {
                                labels: labels,
                                datasets: [
                                    {
                                        label: 'App',
                                        backgroundColor: 'rgb(0, 162, 232)',
                                        borderColor: 'rgb(0, 162, 232)',
                                        data: data_app,
                                    },
                                    {
                                        label: 'Server',
                                        backgroundColor: 'rgb(163, 73, 164)',
                                        borderColor: 'rgb(163, 73, 164)',
                                        data: data_server,
                                    },
                                    {
                                        label: 'User',
                                        backgroundColor: 'rgb(240, 155, 90)',
                                        borderColor: 'rgb(240, 155, 90)',
                                        data: data_user,
                                    },
                                    {
                                        label: 'Workshop',
                                        backgroundColor: 'rgb(24, 125, 54)',
                                        borderColor: 'rgb(24, 125, 54)',
                                        data: data_workshop,
                                    },
                                    {
                                        label: 'Group',
                                        backgroundColor: 'rgb(223, 90, 85)',
                                        borderColor: 'rgb(223, 90, 85)',
                                        data: data_group,
                                    }
                                ]
                            },
                            options: {
                                scales: {
                                    y: {
                                        ticks: {
                                            beginAtZero: true,
                                            callback: function(value) {if (value % 1 === 0) {return value;}}
                                        }
                                    }
                                }
                            }
                        };

                        if (window.statsChart !== null) {
                            window.statsChart.destroy();
                        }
                        
                        window.statsChart = new Chart(
                            content,
                            config
                        );

                        let refcode = '<ul>';
                        response.referrers.forEach(function(referrer, index) {
                            if (referrer.length > 0) {
                                refcode += '<li>' + referrer + '</li>';
                            }
                        });
                        refcode += '</ul>';

                        document.getElementById('referrers').innerHTML = refcode;
                    }
                } else {
                    alert(response.msg);
                }
            });
        },
    }
});

import hljs from 'highlight.js';
import 'highlight.js/scss/github-dark.scss';

window.hljs = hljs;

document.addEventListener('DOMContentLoaded', function(){
    window.hljs.highlightAll();

    window.onscroll = function() {
        if ((document.body.scrollTop > document.getElementsByClassName('navbar')[0].offsetHeight + 10) || (document.documentElement.scrollTop > document.getElementsByClassName('navbar')[0].offsetHeight + 10)) {
            document.getElementsByClassName('navbar')[0].classList.add('navbar-purple');
        } else {
            document.getElementsByClassName('navbar')[0].classList.remove('navbar-purple');
        }
    };

    const obsoptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.7
    };

    const obscallback = function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.replace('fade-out', 'fade-in');
            }
        });
    };

    const observer = new IntersectionObserver(obscallback, obsoptions);

    let fadeElems = document.querySelectorAll('.fade');
    fadeElems.forEach(elem => observer.observe(elem));
});