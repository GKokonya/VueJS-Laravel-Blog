<template>
    <Head title="Create Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Post</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8 ">
                    <div class="mx-auto max-w-lg">
                        <h1 class="text-center text-2xl font-bold text-indigo-600 sm:text-3xl">Create Post</h1>

                        <form class="mt-6 mb-0 space-y-4 bg-white rounded-lg p-8 shadow-2xl" method="POST" @submit.prevent="submit" enctype="multipart/form-data">
                            <div>
                                <label for="title" class="text-sm font-medium">Title</label>
                                <div class="relative mt-1">
                                    <input type="text" v-model="form.title" class="input-text" placeholder="Enter title"/>  
                                </div>
                            </div>

                            <div>
                                <label for="title" class="text-sm font-medium">Category</label>
                                <div class="relative mt-1">
                                    <select v-model="form.category" name="category" id="category"  class="input-text">
                                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.title }}</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="title" class="text-sm font-medium">Category</label>
                                <div class="relative mt-1">
                                    <input type="file" @input="form.image = $event.target.files[0]" accept='image/*'/>
                                </div>
                            </div>

                            <div>
                                <label for="content" class="text-sm font-medium">Content</label>
                                <div class="relative mt-1">
                                    <textarea v-model="form.content" class="input-text" cols="30" rows="10">Enter Content</textarea>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn-submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

let form=reactive({
    title:'',
    content:'',
    category:'',
    image: '',
});

defineProps({
    categories:Array
});

let submit= ()=>{
    Inertia.post('/posts',form, {forceFormData: true});
}
</script>
