<template>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Tags</th>
                </tr>
            </thead>
            <tbody v-if="!tasksLoading">
                <tr v-for="task in tasklist" @click="showEditTaskModal(task)">
                    <td>{{ task.title }}</td>
                    <td>{{ task.priority.title }}</td>
                    <td>{{ task.status.title }}</td>
                    <td>
                        <template v-for="tag in task.tags">
                            <span class="badge badge-secondary mr-2">{{ tag }}</span>
                        </template>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
import TaskEditComponent from './TaskEditComponent.vue';

    export default {
  components: { TaskEditComponent },
        name: 'tasks',
        computed:  {
            ...mapGetters([
                "tasksLoading",
                "tasks"
            ]),
            tasklist () {
                return this.tasks?this.tasks.sort((a, b) => {
                    let comparison = 0;
                    if (a.status.title < b.status.title) {
                        comparison = 1;
                    } else if (a.status.title > b.status.title) {
                        comparison = -1;
                    } else if (a.status.title === b.status.title) {
                        if (a.priority.title < b.priority.title) {
                            comparison = -1;
                        } else if (a.priority.title > b.priority.title) {
                            comparison = 1;
                        }
                    }
                    return comparison;
                }):[]
            },
        },
        async mounted() {
            this.$store.dispatch("fetchTasks")
        },
        data() {
            return {

            }
        },
        methods: {
            showEditTaskModal(task) {
                this.$store.commit('updateTask', task)
                this.$modal.show('taskModal')
            }
        }

    }
</script>
