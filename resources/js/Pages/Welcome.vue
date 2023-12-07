<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue'

const props = defineProps({
    posts: Object,
    langs: Array,
    locale: String,
    locales: Object,
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const selected = ref(false);

const onChange = () => {
    console.log(selected);
}

</script>

<template>
    <Head title="Welcome" />

    <div class="w-full flex flex-col bg-slate-100 min-h-screen">
        <header class="shadow-sm p-8 bg-white">
        <div class="flex justify-between">
            <div>
              <p>{{ selected }}</p>  
              <p>{{ locale }}</p>
            </div>
            <div class="flex gap-2">
                <div v-for="(locale, index) in langs" :key="locale">
                    <a :href="'/language/' + locale" class="p-4 border block text-uppercase text-xs">{{ locale }}</a>
                </div>
            </div>

            <select @change="onChange()" class="form-control" v-model="selected">
                <option v-for="(locale, key) in locales" :key="key" :value="key" :class="{'selected': key === locale}">{{ locale.native }}</option>
            </select>

        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl my-8">
            <section>
                <div v-for="(post, index) in posts" :key="post.id" class="border rounded-md p-8 mb-4 bg-white">
                    <div class="text-2xl font-bold">
                        {{ post.title }}
                    </div>
                </div>
            </section>
        </div>
    </main>
    </div>
    
</template>

    