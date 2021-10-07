<template>
    <div>
        <b-button @click="resetUser()" v-b-modal.modal-1 variant="success">Create</b-button>
        <br>
        <br>

        <Modal>
            <Form :inputs="inputs" :currentUser="currentUser" :errors="errors"/>
        </Modal>

        <b-table hover :items="users" :fields="fields">
            <template #cell(action)="row">
                <b-button @click="getData(row)" v-b-modal.modal-1 variant="info">Update</b-button>
                <b-button @click="deleteUser(row)" variant="danger">Delete</b-button>
            </template>
        </b-table>

        <Link href="/hello"> got to the hello page</Link>
        <notifications group="foo"/>
    </div>
</template>


<script>
import {Link} from '@inertiajs/inertia-vue';
import Modal from "../Modal/Modal";
import Form from "../User/Form";
import {Inertia} from "@inertiajs/inertia";

export default {
    components: {Link, Modal, Form},
    data() {
        return {
            fields: [
                {
                    key: 'name',
                    sortable: true
                },
                {
                    key: 'email',
                    sortable: true
                },
                {
                    key: 'created_at',
                    sortable: true
                },
                {
                    key: 'updated_at',
                    sortable: true
                },
                {
                    key: 'action'
                }

            ],
            currentUser: null,
            inputs: {
                name: {
                    name: 'name',
                    label: 'Name',
                    value: null,
                    placeholder: 'enter name',
                    type: 'text',
                    rules: {required: true, min: 3},
                    error: null
                },
                email: {
                    name: 'email',
                    label: 'Email',
                    value: null,
                    placeholder: "enter email",
                    type: 'text',
                    rules: {email: true, required: true},
                    error: null
                },
            }
        }
    },
    props: {
        users: Array,
        errors: Object
    },
    methods: {
        getData(data) {
            this.currentUser = data.item;
            this.inputs.name.value = this.currentUser.name;
            this.inputs.email.value = this.currentUser.email;
        },
        resetUser() {
            this.inputs.name.value = null;
            this.inputs.email.value = null;
            this.currentUser = null
        },
        deleteUser(data) {
            Inertia.delete(`delete-user/${data.item.id}`, {
                onBefore: () => confirm('Are you sure you want to delete this user?'),
                onSuccess: (data) => {
                    this.$notify({
                        group: 'foo',
                        title: 'Success',
                        type: 'success',
                        text: 'User was successfully deleted!',
                        speed: 1000
                    });
                },
                onError: (errors) => {
                },
            });
        }
    }
};

</script>
