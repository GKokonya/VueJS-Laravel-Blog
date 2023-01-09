<template>
    <Head title="Posts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
        </template>

        <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <Table :headers="headings">
              <tr v-for="post in posts.data" :key="post.id"> 
                <Cell>{{post.id}}</Cell>
                <Cell>{{post.title}}</Cell>
                <Cell><a  class="text-indigo-600 hover:text-indigo-900">Edit</a></Cell>   
              </tr>
            </Table>

            <!--paginator-->
            <Pagination 
            :links="posts.links" 
            :first_page="posts.first_page_url"
            class="mt-2"/>
          </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Pagination from '../Shared/Pagintion.vue'
import Table from '../Shared/Table/Table.vue';
import Cell from '../Shared/Table/Cell.vue';
defineProps({
  posts: Array  
});

const headings=['#ID','DATE','ACTIONS'];
</script>