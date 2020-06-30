<template>
    <form @submit.prevent="create" class="new-task-form" action="#">
        <div class="input-group">
            <input v-model="draft" type="text" class="form-control rounded-right is-invalid">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary rounded-left rounded-right">Crear tarea</button>
            </div>
            <div class="invalid-feedback">
                Hubo un error
            </div>
        </div>

    </form>
</template>

<script>
export default {
    data() {
        return {
            draft: ''
        }
    },
    methods: {
        create() {
            this.$emit('created', {
                description: this.draft,
                pending: true,
                editing: false
            });

            this.draft = '';
        },
    }
}
</script>

<style lang="scss">
    .new-task-form {
        display: flex;
        input {
            margin-right: 10px;
        }
    }

    form > button {
        white-space: nowrap;
    }
</style>
