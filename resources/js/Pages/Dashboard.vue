<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const columns = [
    { data: 'brand' },
    { data: 'model' },
    { data: 'screen_size' },
    { data: 'color' },
    { data: 'harddisk' },
    { data: 'cpu' },
    { data: 'ram' },
    { data: 'OS' },
    { data: 'graphics' },
    { data: 'rating' },
    { data: 'price' },
    { data: null,
            defaultContent: '<button>Detail!</button>',
            targets: -1 },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-12 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <DataTable
                            :data="data"
                            :columns="columns"
                            class="display"
                        >
                            <thead>
                                <tr>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Screen Size</th>
                                    <th>Color</th>
                                    <th>HardDisk</th>
                                    <th>CPU</th>
                                    <th>RAM</th>
                                    <th>OS</th>
                                    <th>Graphics</th>
                                    <th>Rating</th> 
                                    <th>Price</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    data() {
        return {
            data: []
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/api/products')
                .then(response => {
                    const products = JSON.parse(JSON.stringify(response.data.data));
                    this.data = products;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });   
        },
        
    },
};
</script>
