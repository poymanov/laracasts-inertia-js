<template>
    <div class="flex flex-wrap">
        <template v-for="(link, p) in links" :key="p">
                <span v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                      v-html="link.label"/>
            <Link v-else
                  class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-blue-700 hover:text-white focus:border-indigo-500 focus:text-indigo-500"
                  :class="{ 'bg-blue-700 text-white': link.active }" :href="link.url" v-html="link.label"/>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        links: Array
    }
};
</script>
