<script setup>
import AssetSearchSelect from "./AssetSearchSelect.vue";
import PriceChart from "./PriceChart.vue";
</script>

<template>
    <div class="flex flex-col h-full">
        <div class="bg-white p-6 lg:p-8">
            <AssetSearchSelect :emit="emit" />
        </div>

        <div class="flex-grow p-6">
            <PriceChart :symbol="selectedSymbol" />
        </div>
    </div>
</template>



<script>
import { ref } from 'vue';

const selectedSymbol = ref(null);

const emit = (event, data) => {
    selectedSymbol.value = data;
};
</script>
