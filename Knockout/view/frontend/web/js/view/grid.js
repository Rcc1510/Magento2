define([
    'jquery',
    'ko',
    'uiComponent',
    'Kitchen_Knockout/js/view/grid/price'
], function ($, ko, component, priceRender) {
    "use strict";
    
    return component.extend({
        items: ko.observableArray([]),
        columns: ko.observableArray([]),
        defaults: {
            template: 'Kitchen_Knockout/grid',
        },
        initialize: function () {
            this._super();
            this._render();
        },
        _render: function() {
            this._prepareColumns();
            this._prepareItems();                     
        },
        _prepareItems: function () {      
            var data = window.grid_data;     
            this.addItems(data);
        },
        _prepareColumns: function () {
            this.addColumn({headerText: "ID", rowText: "customer_id", renderer: ''});
            this.addColumn({headerText: "First Name", rowText: "first_name", renderer: ''});
            this.addColumn({headerText: "Last Name", rowText: "last_name", renderer: ''});
            this.addColumn({headerText: "Email", rowText: "email", renderer: ''});
            this.addColumn({headerText: "Gender", rowText: "gender", renderer: ''});
            this.addColumn({headerText: "Birth Date", rowText: "birth_date", renderer: ''});
            // this.addColumn({headerText: "Image", rowText: "image", renderer: ''});
            this.addColumn({headerText: "Address", rowText: "address", renderer: ''});
            this.addColumn({headerText: "Status", rowText: "is_active", renderer: ''});
            // this.addColumn({headerText: "Hobbies", rowText: "hobbies", renderer: priceRender});
            this.addColumn({headerText: "NewsLetter Subscription", rowText: "newsLetter_subscription", renderer: ''});
            this.addColumn({headerText: "Create At", rowText: "creation_time", renderer: ''});
            this.addColumn({headerText: "Update At", rowText: "update_time", renderer: ''});
        },
        addItem: function (item) {
            item.columns = this.columns;
            this.items.push(item);
        },
        addItems: function (items) {
            for (var i in items) {
                this.addItem(items[i]);
            }
        },
        addColumn: function (column) {
            this.columns.push(column);
        }
    });
});
