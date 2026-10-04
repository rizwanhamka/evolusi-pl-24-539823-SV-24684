<template>
    <div>
        <h1>Daftar Catatan</h1>
        <ul>
            <li v-for="c in catatans" :key="c.id">
                <strong>{{ c.judul }}</strong> — {{ truncateText(c.isi, 50) }}
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { truncateText } from "../utils/text";

const catatans = ref([]);
const apiUrl = import.meta.env.VITE_API_URL;

onMounted(async () => {
    try {
        const res = await axios.get(`${apiUrl}/catatans`);
        catatans.value = res.data;
    } catch (e) {
        console.error("Gagal mengambil data:", e);
    }
});
</script>
