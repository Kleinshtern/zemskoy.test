<script setup>
    const props = defineProps({
       title: {
           type: String,
           required: false,
           default: "Card title"
       },
       body: {
           type: String,
           required: false,
           default: "Card body"
       },
       backgroundImage: {
           type: String,
           required: false,
           default: null
       },
       scaled: {
          type: Boolean,
          required: false,
          default: true
       },
       animated: {
           type: Boolean,
           required: false,
           default: true
       },
       link: {
          type: String,
          required: false,
          default: null
       }
    });
</script>

<template>
    <div
        class="card shadow-md rounded-md"
        :class="`${animated ? 'animated' : ''} ${scaled ? 'scaled' : ''} ${link ? 'link' : ''}`"
    >
        <template v-if="link">
            <a class="overflow__link" :href="link"></a>
        </template>
        <div class="card-title">
            <template v-if="backgroundImage">
                <div class="card-title__image">
                    <div class="overflow__image" :style="backgroundImageStyle"></div>
                    <div class="overflow__title">
                        <slot name="title">
                            {{ title }}
                        </slot>
                    </div>
                </div>
            </template>
            <template v-else>
                <slot name="title">
                    {{ title }}
                </slot>
            </template>
        </div>
        <div class="card-body">
            <slot name="body">
                {{ body }}
            </slot>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            backgroundImageStyle: function() {
                return {
                    'background-image': `url(${this.backgroundImage})`
                }
            }
        }
    }
</script>

<style scoped lang="scss">
    .card {
        position: relative;
        user-select: none;

        overflow: hidden;

        width: 100%;
        background: white;

        transition-property: transform;
        transition-duration: 0.2s;
        transition-timing-function: ease;

        &.animated {
            animation: showing 1s ease-in-out;
        }

        &.scaled:hover {
            transform: scale(1.05);
        }
        &.link:hover {
            cursor: pointer;
        }

        .overflow__link {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2;

            width: 100%;
            height: 100%;

            cursor: pointer;
        }

        .card-body {
            padding: 10px 15px;
        }

        .card-title {
            height: fit-content;

            font-size: 1.2em;
            font-weight: bold;

            .card-title__image {

                position: relative;

                min-height: 200px;
                padding: 10px 15px;

                .overflow__image {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-size: cover;
                    background-repeat: no-repeat;

                    &::after {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0, 0, 0, 0.5);
                    }
                }
                .overflow__title {
                    color: white;

                    position: absolute;
                    left: 15px;
                    bottom: 10px;
                    z-index: 1;
                }
            }
        }
    }

    @keyframes showing {
        from { opacity: 0; transform: translateY(-15px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
