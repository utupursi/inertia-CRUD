<template>
    <div>
        <div v-for="(message,index) in messages" :key="index">
            {{ message.text }}
        </div>

        <button class="btn btn-success" v-on:click="showBox">Add message</button>

        <form>
            <div class="form-group" v-for="item in texts">
                    <input v-if="item.type=='input'" v-model="item.value" class="form-control" :name="item.name" :placeholder="item.placeholder"/>
                {{ item.value }}
            </div>
        </form>
        <Link href="/contact">got to the contasct page</Link>
    </div>
</template>

<script>

import {Link} from "@inertiajs/inertia-vue";

export default {
    components: {Link},

    data: () => {
        return {
            texts: [
                {
                    name: 'name',
                    placeholder: 'type name',
                    value: null,
                    type: 'input'
                },
                {
                    name: 'surname',
                    placeholder: 'type surname',
                    value: null,
                    type: 'input'
                },
                {
                    name: 'email',
                    placeholder: 'type email',
                    value: null,
                    type: 'input'
                },
                {
                    name: 'phone',
                    placeholder: 'type phone',
                    value: null,
                    type: 'input'
                }
            ]
        }
    },

    props: {
        messages: Array
    },
    methods: {
        showBox: function () {
            this.texts.push({value: null})
        }
    }


};
</script>
