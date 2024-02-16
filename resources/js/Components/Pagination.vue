<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue'

const props = defineProps({
  links: Array,
})

// Get the count of links
// const numberOfLinks = computed(() => props.links.length);

</script>

<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, key) in links" :key="`link-${key}`">
        <component
          :is="link.url === null ? 'div' : 'Link'"
          v-if="link.url === null"
          class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded"
          v-html="link.label"
        />
        <Link
          v-else
          class="mb-1 mr-1 px-4 py-3 focus:text-indigo-600 text-sm leading-4 hover:bg-white border focus:border-indigo-600 rounded"
          :class="{ 'bg-white': link.active }"
          :href="link.url"
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>
