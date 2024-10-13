<!-- <template>
    <title>{{ title }}</title>
</template>
  
  <script setup>
  import { defineProps, watch, onMounted } from 'vue';
  
  const props = defineProps({
    title: String
  });
  
  watch(() => props.title, (newTitle) => {
    document.title = newTitle;
  });
  
  onMounted(() => {
    if (props.title) {
      document.title = props.title;
    }
  });
  </script>
   -->