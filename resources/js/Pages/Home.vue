<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue'

defineProps({
    posts: {
        type: Object,
        default: []
    },
    locales: {
        type: Object,
        default: {
            'en': {

            }
        },
    },
    locale: {
        type: String,
        default: 'en'
    }
});
</script>

<template>
    <Head title="Welcome" />

    <div class="w-full bg-slate-100 min-h-screen">

        <header class="shadow bg-slate-800 text-slate-200">

            <div class="mx-auto max-w-7xl">

                <div class="flex justify-between items-center px-2 sm:px-4 py-4">
                    <div class="text-xs text-sky-300">
                        <span class="uppercase">{{ locale }}</span>
                    </div>
                    <div class="uppercase text-sm font-semibold">
                        - Logo - 
                    </div>

                    <div class="flex uppercase text-sm space-x-3">

                        <Link :href="route('swicher', code)" v-for="(locale, code) in locales" :key="code" :class="{'font-semibold text-sky-300' : code == $page.props.locale}">
                            {{ code }}
                        </Link>

                    </div>
                </div>

            </div>

        </header>

        <div class="mx-auto max-w-7xl my-8">

            <section class="w-full p-2 sm:p-4">

                <div>
                   
                </div>

                <div v-for="post in posts" :key="post.id">

                    <div class="sm:p-6 bg-slate-50 mb-3 w-full rounded-lg shadow">
                        <h1 class="font-semibold">{{ post.title }}</h1>
                    </div>

                </div>

            </section>
        </div>

    </div>
</template>