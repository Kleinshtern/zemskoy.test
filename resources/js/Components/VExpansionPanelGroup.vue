<template>
    <div class="expansion-panel__group shadow-md">
        <slot />
    </div>
</template>

<style lang="scss">
    .expansion-panel__group {
        display: flex;
        flex-direction: column;
        height: 100%;

        border-radius: 10px;
        overflow: hidden;

        .expansion-panel {
            margin: 0 !important;
            padding: 0;

            box-shadow: none;
            border-radius: 0;

            > .expansion-panel__header {
                border-radius: 0;
            }
            > .expansion-panel__body {
                border-radius: 0;
            }
        }
    }
</style>
