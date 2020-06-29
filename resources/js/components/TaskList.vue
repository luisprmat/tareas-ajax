<template>
    <ul class="list-group tasks-list">
        <app-task v-for="task in tasks"
            :task="task"
            :key="task.id"
            @remove="deleteTask(task.id)"
        ></app-task>
    </ul>
</template>

<script>
import Task from './Task.vue'

export default {
    components: {
        'app-task': Task
    },
    props: ['tasks'],
    methods: {
        deleteTask(id) {
            const index = this.tasks.map(el => el.id).indexOf(id)
            axios.delete(`/api/tasks/${id}`)
                .then(response => {
                    if(response.data.success) this.tasks.splice(index, 1)
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        },
    }
}
</script>

<style lang="scss">
    .tasks-list {
        margin-bottom: 40px;
    }
</style>
