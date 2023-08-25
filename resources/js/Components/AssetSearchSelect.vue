<template>
    <div>
        <input
            type="text"
            placeholder="Search..."
            v-model="searchQuery"
            class="input"
            @input="debouncedFilterAssets"
        />
        <ul v-if="searchQuery" class="list">
            <li
                v-for="asset in searchedAssets"
                :key="asset.symbol"
                @click="selectAsset(asset)"
                @mouseover="highlightAsset(asset)"
                :class="{ 'highlighted': asset.highlighted }"
            >
                {{ asset.name }} ({{ asset.symbol }})
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { debounce } from 'lodash';

const searchQuery = ref("");
const assets = ref([]);
const { emit } = defineProps(['emit']);

const cacheDuration = 3600 * 1000; // 1 hour in milliseconds
const cacheKey = 'cachedAssets';
const lastCacheTimeKey = 'lastCacheTime';

const lastCacheTime = ref(localStorage.getItem(lastCacheTimeKey) || 0);

const shouldFetchAssets = computed(() => {
    const currentTime = Date.now();
    return currentTime - lastCacheTime.value > cacheDuration;
});

const debouncedFilterAssets = debounce(() => {
    fetchAssetsIfNeeded();
}, 1050);

const searchedAssets = computed(() => {
    const filtered =  assets.value.filter((asset) => {
        const lowerSearchQuery = searchQuery.value.toLowerCase();
        return (
            asset.name.toLowerCase().includes(lowerSearchQuery)
        );
    });

    return filtered.slice(0, 10)
});

onMounted(() => {
    fetchAssetsIfNeeded();
});

const fetchAssetsIfNeeded = () => {
    if (shouldFetchAssets.value) {
        fetchAssets();
    } else {
        retrieveCachedAssets();
    }
};

const fetchAssets = () => {
    axios
        .get('/fetch-assets')
        .then(response => {
            assets.value = response.data.assets;
            cacheAssets(response.data.assets);
        })
        .catch(error => {
            console.error(error);
        });
};

const retrieveCachedAssets = () => {
    const cachedData = localStorage.getItem(cacheKey);
    if (cachedData) {
        assets.value = JSON.parse(cachedData);
    }
};

const cacheAssets = (data) => {
    localStorage.setItem(cacheKey, JSON.stringify(data));
    localStorage.setItem(lastCacheTimeKey, Date.now());
};

const selectAsset = (asset) => {
    searchQuery.value = `${asset.name} (${asset.symbol})`;
    emit('symbolSelected', asset.symbol);
};

const highlightAsset = (asset) => {
    for (const a of searchedAssets.value) {
        a.highlighted = a === asset;
    }
};

</script>

<style scoped>
.list {
    list-style-type: none;
    padding: 0;
    border: 1px solid #ccc;
    position: absolute;
    background-color: white;
    width: 500px;
    max-width: 500px;
}
.list li {
    padding: 8px;
    cursor: pointer;
    border-bottom: 1px solid #ccc;
}

.list li.highlighted {
    background-color: #f5f5f5;
}

.input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    transition: border-color 0.3s;
}

.input:focus {
    outline: none;
    border-color: #4c9aff;
}
</style>
