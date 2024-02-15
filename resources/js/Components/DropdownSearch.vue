<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { createPopper } from '@popperjs/core';

const show = ref(false);
let popper = null;

const toggleDropdown = () => {
  show.value = !show.value;
};

const closeDropdown = () => {
  show.value = false;
};

const closeOnClickOutside = () => {
  if (props.autoClose) {
    closeDropdown();
  }
};

const handleKeydown = (e) => {
  if (e.key === 'Escape') {
    closeDropdown();
  }
};

onMounted(() => {
  document.addEventListener('keydown', handleKeydown);
});

onBeforeUnmount(() => {
  document.removeEventListener('keydown', handleKeydown);
  if (popper) {
    popper.destroy();
  }
});

const handleShowChange = (newShow) => {
  if (newShow) {
    nextTick(() => {
      popper = createPopper(this.$el, this.$refs.dropdown, {
        placement: props.placement,
        modifiers: [
          {
            name: 'preventOverflow',
            options: {
              altBoundary: true,
            },
          },
        ],
      });
    });
  } else if (popper) {
    setTimeout(() => popper.destroy(), 100);
  }
};
</script>

<template>
  <button type="button" @click="toggleDropdown">
    <slot />
    <teleport v-if="show" to="#dropdown">
      <div>
        <div
          style="position: fixed; top: 0; right: 0; left: 0; bottom: 0; z-index: 99998; background: black; opacity: 0.2"
          @click="closeDropdown"
        />
        <div ref="dropdown" style="position: absolute; z-index: 99999" @click.stop="closeOnClickOutside">
          <slot name="dropdown" />
        </div>
      </div>
    </teleport>
  </button>
</template>
