<template>
    <div>
        <button @click="toggleDark">
            {{ isDarkMode ? 'Przełącz na tryb jasny' : 'Przełącz na tryb ciemny' }}
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const isDarkMode = ref(false);

const toggleDark = function () {
    if (localStorage.theme === 'dark') {
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light';
        isDarkMode.value = false;
    } else {
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark';
        isDarkMode.value = true;
    }
};

// Ustawienie początkowego trybu na podstawie lokalnego magazynu
onMounted(() => {
    if (localStorage.theme === 'dark') {
        document.documentElement.classList.add('dark');
        isDarkMode.value = true;
    } else {
        document.documentElement.classList.remove('dark');
        isDarkMode.value = false;
    }
});
</script>
