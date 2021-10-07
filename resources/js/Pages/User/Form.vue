<template>
    <div>
        <validation-observer ref="observer" v-slot="{ handleSubmit }">

            <b-form @submit.stop.prevent="handleSubmit(onSubmit)" @reset="onReset">
                <validation-provider v-for="(item,index) in inputs" :key="index" :name="item.name"
                                     :rules="item.rules" v-slot="validationContext">
                    <b-form-group
                        id="input-group-1"
                        :label="item.label"
                        label-for="input-1"
                    >
                        <b-form-input
                            :id="item.name"
                            :type="item.type"
                            v-model="item.value"
                            @input="hideErrorMessage(item.name)"
                            :placeholder="item.placeholder"
                            :state="getValidationState(validationContext)"

                        ></b-form-input>
                        <p hidden :ref="item.name" style="color:red">{{ item.error }}</p>
                        <b-form-invalid-feedback id="input-2-live-feedback">{{
                            validationContext.errors[0]
                            }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                </validation-provider>
                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button @click="onReset()" type="reset" variant="danger">Reset</b-button>
            </b-form>
        </validation-observer>
    </div>
</template>

<script>
import {Inertia} from "@inertiajs/inertia";

export default {
    name: "form",

    methods: {
        getValidationState({dirty, validated, valid = null}) {
            return dirty || validated ? valid : null;
        },
        onSubmit(event) {
            let obj = {
                name: this.inputs.name.value,
                email: this.inputs.email.value
            }
            if (!this.currentUser) {
                Inertia.post('save-data', obj, {
                    onSuccess: (data) => {
                        this.$bvModal.hide('modal-1');
                        this.inputs.name.value = null;
                        this.inputs.email.value = null;
                        this.$notify({
                            group: 'foo',
                            title: 'Success',
                            type: 'success',
                            text: 'User was successfully created!',
                            speed: 1000
                        });
                    },
                    onError: (errors) => {
                        this.setErrors(errors);
                    },
                });
            } else {
                obj['id'] = this.currentUser.id;
                Inertia.post('update-user', obj, {
                    onSuccess: (data) => {
                        this.$bvModal.hide('modal-1');
                        this.inputs.name.value = null;
                        this.inputs.email.value = null;
                        this.inputs.name.error = null;
                        this.inputs.email.error = null;
                        this.$notify({
                            group: 'foo',
                            title: 'Success',
                            type: 'success',
                            text: 'User was successfully updated!',
                            speed: 1000
                        });
                    },
                    onError: (errors) => {
                        this.setErrors(errors);
                    },
                });
            }
        },
        onReset(event) {
            let data = this.inputs;
            for (const key in data) {
                data[key].value = null
            }
        },
        setErrors(errors) {
            let data = this.inputs;
            for (const key in data) {
                this.$refs[key][0].hidden = false;
                data[key].error = errors[key] ?? null;
            }
        },
        hideErrorMessage(key) {
            this.$refs[key][0].hidden = true;
        }
    },
    props: {
        errors: Object,
        inputs: Object,
        currentUser: Object
    }
}
</script>

<style scoped>

</style>
