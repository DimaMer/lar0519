<template>
    <div>
        <div>
            <input type="submit"
                   value="send to site">
            <input type="text"
                   placeholder="Search all"
                   v-model="query">

            <span>
                <button class="btn"
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

        <div v-if="view" display="none">
            <p class="page">
                <div class="page">
                    found-{{job.length}}-jobs
                </div>
                <button type="button"
                        @click="prevPage">
                    Previous
                </button>
                <span>
                    {{currentPage}}
                </span>
                <button type="button"
                        @click="nextPage">
                    Next
                </button>
                <button type="button"
                        @click="allpage">
                    All page
                </button>
                <span>
                    {{Math.ceil(job.length/4)}}-pages
                </span>
            </p>
            <table class="table">
                <thead>
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
    .table {
        border-collapse: collapse;
        border-top: 3px solid #a5c0f7;
        border-left: 3px solid #a5c0f7;
        border-right: 3px solid #a5c0f7;
        border-bottom: 3px solid #a5c0f7;
        font-family: "Lucida Grande", sans-serif;
    }
    .table td, .table th {
        padding: 10px;
        text-align: center;
        border-bottom: 3px solid #a5c0f7;
        border-right: 3px solid #a5c0f7;
    }
    .table th {
        text-align: center;
        font-size: 14px;
        border-bottom: 3px solid #a5c0f7;
        border-right: 3px solid #a5c0f7;
    }
    .table tr:nth-child(2n) {
        background: #E5E5E5;
    }

    .table td:last-of-type {
        text-align: center;
    }
    .table th:hover {
        background: lightcyan;
        top: 2px;
        left: 2px;
    }
    .tooltip {
        display: none;
    }
    th:hover .tooltip {
        display: inline;
    }
    .page {
        font-size: 26px;
    }
</style>