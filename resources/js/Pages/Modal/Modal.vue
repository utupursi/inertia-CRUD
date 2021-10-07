<template>
    <div>
        <b-modal ref="my-modal" id="modal-1" title="BootstrapVue">
            <slot></slot>
        </b-modal>
    </div>
</template>


<script>
import {Link} from '@inertiajs/inertia-vue'
import {Inertia} from '@inertiajs/inertia'


export default {
    components: {Link},
    data() {
        return {}
    },
};

</script>
