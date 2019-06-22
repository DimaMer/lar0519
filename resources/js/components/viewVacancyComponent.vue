<template>
    <div class="container">
        <div>
        <div class="mx-auto">
            <input type="submit" class="btn btn-success"
                   value="send to site">
            <input type="text"
                   placeholder="Search all"
                   v-model="query">

            <span>

                <button class="btn btn-primary"
                        type="button"
                        @click="search()"
                        v-if="!loading">
                    Search!
                </button>
                <button
                        class="btn"
                        type="button"
                        disabled="disabled"
                        v-if="loading">
                    Searching...
                </button>
            </span>
        </div>

        <div v-if="error">
            <span aria-hidden="true"></span>
            {{ error }}
        </div>
</div>
        <div v-if="view" display="none">
            <p class="page">
                <div class="badge badge-secondary text-wrap" >
                    found-{{job.length}}-jobs
                </div>
                <button type="button" class="btn btn-primary btn-sm"
                        @click="prevPage">
                    Previous
                </button>
                <span class="badge badge-secondary text-wrap" >
                    {{currentPage}}
                </span>
                <button type="button" class="btn btn-primary btn-sm"
                        @click="nextPage">
                    Next
                </button>
                <button type="button"  class="btn btn-primary btn-sm"
                        @click="allpage">
                    All page
                </button>
                <span class="badge badge-secondary text-wrap" >
                    {{Math.ceil(job.length/4)}}-pages
                </span>
            </p>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            select all</br>
                            <input name='all' type="checkbox" value='all'>
                        </th>
                        <th @click="sort('vacancy')">
                            Vacancy
                            <p class="tooltip">
                                <br>sort
                            </p>
                        </th>
                        <th @click="sort('company')">
                            Company
                            <p class="tooltip">
                                <br>sort
                            </p>
                        </th>
                        <th>
                            describe
                        </th>
<th @click="sort('time')">
                            time
                            <p class="tooltip">
                                <br>sort
                            </p>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="(product, key) in sorted">
                        <td>
                            <input v-bind:name=key
                                   type="checkbox"
                                   v-bind:value=product.indexjob>
                            <span>
                                select
                            </span>
                        </td>
                        <td>
                            {{product.vacancy}}
                        </td>
                        <td>
                            {{product.company}}
                        </td>
                        <td>
                            {{product.vacancyInfoWrapper}}
                        </td>
<td>
                            {{product.time}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>

    export default {
        data () {
            return {
                job: [],
                loading: false,
                error: false,
                query: '',
                view: false,
                currentSort: '',
                currentSortDir: 'asc',
                pageSize: 3,
                currentPage: 1
            }
        },
        computed: {
            sorted: function () {
                return this.job.sort((a, b) => {
                    let modifier = 1;
                    if (this.currentSortDir === 'desc') modifier = -1;
                    if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                    if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                    return 0;
                }).filter((row, index) => {
                    let start = (this.currentPage - 1) * this.pageSize;
                    let end = this.currentPage * this.pageSize;
                    if (index >= start && index < end) return true;
                });
            }
        },
        methods: {
            search: function () {
                this.error = '';
                this.pageSize = 3;
                this.currentPage = 1;
                this.job = [];
                this.loading = true;
                this.$http.get('/api/search?q=' + this.query).then((response) => {
                    response.body.error ? this.error = response.body.error : this.job = response.body;
                    this.loading = false;
                    this.view = true;
                    this.error ? this.view = false : this.view = true
                });
            },
            sort: function (s) {
                if (s === this.currentSort) {
                    this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
                }
                this.currentSort = s;
            },
            nextPage: function () {
                if ((this.currentPage * this.pageSize) < this.job.length) this.currentPage++;
            },
            prevPage: function () {
                if (this.currentPage > 1) this.currentPage--;
            },
            allpage: function () {
                this.pageSize = 1000;
                this.currentPage = 1;
                this.job;
            }
        }
    }
</script>
<style>
    
    .table th:hover {
        background: grey;
        top: 2px;
        left: 2px;
    }
    .tooltip {
    display: none;
        position: relative;
    }
    
    th:hover .tooltip{
        display: inline;
         opacity: 0.7; 
    }
    .page {
        font-size: 26px;
    }
</style>
