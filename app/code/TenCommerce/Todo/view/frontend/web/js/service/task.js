define(['mage/storage'], function(storage) {
   'use strict';

   return {
       getList: async function() {
           return await storage.get('rest/V1/customer/todo/tasks');
       },

       create: async function(taskObjNotId) {
           return await storage.post(
               'rest/V1/customer/todo/task/create',
               JSON.stringify({
                   task: taskObjNotId
               })
           );
       },

       update: async function(taskId, status) {
           return await storage.post(
               'rest/V1/customer/todo/task/update',
               JSON.stringify({
                   taskId: taskId,
                   status: status
               })
           );
       },

       delete: async function(taskObjNotId) {
           return await storage.post(
               'rest/V1/customer/todo/task/delete',
               JSON.stringify({
                   task: taskObjNotId
               })
           );
       }
   };
});
