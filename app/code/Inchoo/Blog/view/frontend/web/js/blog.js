define(['uiComponent'], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Inchoo_Blog/blog'
        },
        initialize: function () {
            this._super();

            return this;
        }
    });
});
