new Vue({

    el: 'body',

    data: {
        job: [],
        loading: false,
        error: false,
        query: ''
    },

    methods: {
        search: function() {

            this.error = '';

            this.job = [];

            this.loading = true;

            this.$http.get('/api/search?q=' + this.query).then((response) => {

                response.body.error ? this.error = response.body.error : this.job = response.body;

                this.loading = false;

                this.query = '';
            });
        }
    }

});