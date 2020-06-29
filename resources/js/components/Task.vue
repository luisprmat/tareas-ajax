<template>
<li class="list-group-item task-list-item"
    :class="{editing: editing, completed: !task.pending}">
    <a @click="toggleStatus" href="#">
        <app-icon :img="task.pending ? 'unchecked' : 'check'"></app-icon>
    </a>

    <template v-if="!editing">
        <span  class="description">{{ task.description }}</span>
        <div>
            <a @click="edit" href="#">
                <app-icon img="edit"></app-icon>
            </a>
            <a @click="remove" href="#">
                <app-icon img="trash"></app-icon>
            </a>
        </div>
    </template>

    <template v-else>
        <input type="text" v-model="draft">

        <div>
            <a @click="update" href="#">
                <app-icon img="ok"></app-icon>
            </a>
            <a @click="discard" href="#">
                <app-icon img="remove"></app-icon>
            </a>
        </div>
    </template>
</li>
</template>

<script>
import EventBus from '../event-bus.js'
import Icon from './Icon.vue'
import axios from 'axios'

const base_url = window.location.origin;

export default {
    components: {
        'app-icon': Icon
    },
    data() {
        return {
            editing: false,
            draft: '',
        };
    },
    props: ['task', 'index'],
    created() {
        EventBus.$on('editing', function (index) {
            if (this.index != index) {
                this.discard();
            }
        }.bind(this));
    },
    methods: {
        toggleStatus() {
            axios.put(base_url + '/api/tasks/' + this.task.id, {
                status: this.task.pending ? 'completed' : 'pending'
            }).then(response => {
                this.task.pending = !this.task.pending;
            })
        },
        edit() {
            EventBus.$emit('editing', this.index);

            this.draft = this.task.description;

            this.editing = true;
        },
        update() {
            axios.put(base_url + '/api/tasks/' + this.task.id, {
                title: this.draft
            }).then(response => {
                this.task.description = this.draft;

                this.editing = false;
            })
        },
        discard() {
            this.editing = false;
        },
        remove() {
            this.$emit('remove', this.id);
        },
    }
}
</script>

<style lang="scss">
	.task-list-item {
		display: flex;
		justify-content: space-between;

		a {
			text-decoration: none;
		}

		&.editing {
			box-shadow: inset 0 0 5px #999;
		}

		input, .description {
			flex: 1;
			padding: 0 5px;
		}

		input {
			border: 0;

			&:focus {
				outline: none;
			}
		}

		&.completed {
			&, a {
				color: #999;
			}

			.description {
				text-decoration: line-through;
			}
		}
	}
</style>
