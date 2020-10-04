define([
    'uiComponent',
    'jquery',
    'Magento_Ui/js/modal/confirm',
    'TenCommerce_Todo/js/service/task',
    'TenCommerce_Todo/js/model/loader'
], function(Component, $, modal, taskService, loader) {
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

        addTask: async function() {
            var self = this;

            // new task template
            var newTask = {
                //task_id: Math.floor(Math.random() * 100),
                label: self.newTaskLabel(),
                status: 'complete'
            };

            // // === one way ===
            // loader.startLoader();
            // taskService.create(newTask)
            //     .then(function(taskId) {
            //         newTask.task_id = taskId;
            //         self.tasks.push(newTask);
            //     })
            //     .finally(function() {
            //         setTimeout(function() {
            //             loader.stopLoader()
            //         }, 500); // add extra long Magento wait
            //         self.newTaskLabel('');
            //     });

            // === my way ===
            // save task and wait for id from db
            //console.log('Saving task...');
            var start = new Date().getTime();
            loader.startLoader(); // spinner

            var newTaskId = await taskService.create(newTask);
            //console.log('newTaskId: ' + newTaskId);

            // log execution time
            var end = new Date().getTime();
            var time = end - start;
            console.log('Add task [' + newTaskId + '] latency: ' + time + 'ms');

            // Add id to task obj and push to view
            newTask.task_id = newTaskId;
            this.tasks.push(newTask);
            this.newTaskLabel('');
            loader.stopLoader(); // spinner
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
