define([
    'uiComponent',
    'jquery',
    'Magento_Ui/js/modal/confirm',
    'TenCommerce_Todo/js/service/task'
], function(Component, $, modal, taskService) {
    'use strict';

    return Component.extend({
        defaults: {
            buttonSelector: '#add-new-task-button',
            newTaskLabel: '',
            tasks: [
                {id: 1, label: "Task 1", status: false},
                {id: 2, label: "Task 2", status: true},
                {id: 3, label: "Task 3", status: false},
                {id: 4, label: "Task 4", status: true}
            ]
        },
        tasks2: [],

        initObservable: function() {
            this._super().observe(['tasks', 'tasks2', 'newTaskLabel']);

            var self = this;
            taskService.getList().then(function(tasks) {
                self.tasks(tasks);
                return tasks;
            });

            // make a copy of tasks
            this.tasks2().push(...this.tasks());
            this.tasks2().push({label: "Task 5"});

            // shuffle for fun
            this.shuffle(this.tasks2());

            return this;
        },

        switchStatus: function(data, event) {
            const taskId = $(event.target).data('id');

            var items = this.tasks().map(function (task) {
                if (task.task_id === taskId) {
                    task.status = task.status === 'open' ? 'complete' : 'open';
                    taskService.update(taskId, task.status);
                }

                return task;
            });

            this.tasks(items);
        },

        addTask: function() {
            this.tasks.push({
               id: Math.floor(Math.random() * 100),
               label: this.newTaskLabel(),
               status: false
            });
            this.newTaskLabel('');
        },

        checkKey: function(data, event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $(this.buttonSelector).click();
            }
        },

        deleteTask: function(taskId) {
            var self = this;

            modal({
                content: 'Are you sure you want to delete this task?',
                actions: {
                    confirm: function() {
                        console.log('Running DELETE function');
                        var tasks = [];

                        if (self.tasks().length === 1) {
                            console.log('Deleted last remaining task before forEach');
                            self.tasks(tasks);
                            return;
                        }
                        self.tasks().forEach(function (task) {
                            if (task.task_id !== taskId) {
                                tasks.push(task); // tasks to keep
                                console.log('Keeping: [task_id: ' + task.task_id + '] ' + task.label);
                            } else {
                                taskService.delete(task); // delete the one task
                                console.log('Deleting: [task_id: ' + task.task_id + '] ' + task.label);
                            }
                        });

                        self.tasks(tasks);
                    }
                }
            });
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
