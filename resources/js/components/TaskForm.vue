<template>
    <form @submit.prevent="create" class="new-task-form" action="#">
        <div class="input-group">
            <input v-model="draft"
                type="text"
                class="form-control rounded-right"
                :class="{'is-invalid': errors.length}"
            >
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary rounded-left rounded-right">Crear tarea</button>
            </div>
            <div v-if="errors.length" class="invalid-feedback">{{ errors[0] }}</div>
        </div>

    </form>
</template>

<script>
import EventBus from '../event-bus';

export default {
    data() {
        return {
            draft: '',
            errors: []
        }
    },
    created() {
        EventBus.$on('isErrors', (errors) => {
            this.errors = errors
            if(! this.errors.length) this.draft = ''
        })
    },
    methods: {
        create() {
            this.$emit('created', {
                description: this.draft,
                pending: true,
                editing: false
            })

            if(! this.errors.length) this.draft = ''
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
