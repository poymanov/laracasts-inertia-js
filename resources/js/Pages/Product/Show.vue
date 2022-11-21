<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

let props = defineProps({
    product: Object,
});
</script>

<template>
    <Head :title="'Product: ' + product.id"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product (ID: {{ product.id }})
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="p-4">
                            <div>
                                <div class="mb-5">
                                    <Link v-html="'Back'" :href="route('products.index')" class="my-2 bg-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 rounded text-white uppercase px-6 py-2 text-xs focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600"/>
                                </div>
                                <div>
                                    Name: {{ product.name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
