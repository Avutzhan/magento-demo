define(['uiComponent'], function (Component) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();

            console.log(this.title);

            return this;
        }
    });
});
