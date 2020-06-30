<template>
<div id="app" class="container">
    <h2>Tareas</h2>

    <app-task-list :tasks="tasks"></app-task-list>

    <p><a @click.prevent="deleteCompleted" href="#" class="btn btn-light">Eliminar tareas completadas</a></p>

    <app-task-form @created="createTask"></app-task-form>

    <!-- <pre class="code pre-scrollable">{{ tasks }}</pre> -->

    <footer class="footer">
        <p>&copy; 2019. {{ name }}. Derechos reservados</p>
    </footer>
</div>
</template>

<script>
import axios from 'axios'
import EventBus from './event-bus.js'
import TaskList from './components/TaskList.vue'
import TaskForm from './components/TaskForm.vue'

export default {
    components: {
        'app-task-list': TaskList,
        'app-task-form': TaskForm
    },
	data() {
        return {
            name: 'Luis Parrado',
            task_aj: [],
            new_task: '',
            tasks: [],
            serverErrors: []
        }
    },
    methods: {
        getTasks() {
            axios.get('/api/tasks')
                .then(response => {
                    this.task_aj = response.data;

                    this.task_aj.forEach(item => {
                        this.tasks.push(this.setTask(item));
                    })
                })
                .catch(function(error) {
                    console.log(error.response.data)
                });
        },
        setTask(task) {
            return {
                id: task.id,
                description: task.title,
                pending: task.status === 'pending' ? true : false
            }
        },
        createTask(task) {
            axios.post('/api/tasks', {
                title: task.description
            })
            .then(response => {
                this.tasks.push(this.setTask(response.data.task))
                EventBus.$emit('isErrors', [])
            })
            .catch(error => {
                this.serverErrors = error.response.data.errors.title
                EventBus.$emit('isErrors', this.serverErrors)
            })
        },
        deleteCompleted() {
            axios.delete('/api/tasks')
                .then(response => {
                    this.tasks = [];
                    this.getTasks()
                })
                .catch(error => {
                    console.log(error.response.data)
                })
        }
    },
    mounted() {
        this.getTasks()
    }
}
</script>

<style lang="scss">
    body {
        margin: 10px;
    }

    .container {
        max-width: 670px;

        h2 {
            margin-bottom: 20px;
        }

        .footer {
            margin: 40px 0;
            padding-top: 20px;
            border-top: 1px solid #ccc;
            color: lightslategrey;
        }
    }

    .code {
        background-color: lightgray;
    }
</style>
