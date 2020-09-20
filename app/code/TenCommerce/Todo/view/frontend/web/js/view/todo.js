define(['uiComponent'], function(Component) {
    'use strict';

    return Component.extend({
        defaults: {
            tasks: [
                {label: "Task 1"},
                {label: "Task 2"},
                {label: "Task 3"},
                {label: "Task 4"}
            ]
        },
        tasks2: [],

        initObservable: function() {
            this._super().observe(['tasks', 'tasks2']);

            // make a copy of tasks
            this.tasks2().push(...this.tasks());
            this.tasks2().push({label: "Task 5"});

            // shuffle for fun
            this.shuffle(this.tasks2());

            return this;
        },

        /**
         * Shuffles array in place. ES6 version
         * @param {Array} a items An array containing the items.
         */
        shuffle: function(a) {
            for (let i = a.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [a[i], a[j]] = [a[j], a[i]];
            }
            return a;
        },

        ///**
        // * Shuffles array in place.
        // * @param {Array} a items An array containing the items.
        // */
        //shuffle: function shuffle(a) {
        //    var j, x, i;
        //    for (i = a.length - 1; i > 0; i--) {
        //        j = Math.floor(Math.random() * (i + 1));
        //        x = a[i];
        //        a[i] = a[j];
        //        a[j] = x;
        //    }
        //    return a;
        //},

    });
});
