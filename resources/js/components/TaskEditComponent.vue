<template>
    <div>
        <button type="button" class="btn btn-sm btn-outline-secondary" @click="showModal">Create New Task</button>
        <modal name="taskModal" classes="p-4" height="auto" :adaptive="true">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="title">Title</label>
                        <input 
                        type="text" 
                        class="form-control" 
                        :class="{ 'is-invalid': 'title' in errors }" 
                        id="title" 
                        placeholder="Task title" 
                        v-model="task.title">
                        <div class="invalid-feedback" v-if="'title' in errors">
                            {{ errors.title[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="priority">Priority</label>
                        <v-select 
                            :class="{ 'is-invalid': 'priority' in errors }"
                            :options="priorities"
                            :reduce="title => title.id"
                            label="title"
                            :value="task.priority"
                            @input="setSelectedPriority"
                        ></v-select>
                        <div class="invalid-feedback" v-if="'priority' in errors">
                            {{ errors.priority[0] }}
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="status">Status</label>
                        <v-select 
                            :class="{ 'is-invalid': 'status' in errors }"
                            :options="statuses"
                            :reduce="title => title.id"
                            label="title"
                            :value="task.status"
                            @input="setSelectedStatus"
                        ></v-select>
                         <div class="invalid-feedback" v-if="'status' in errors">
                            {{ errors.status[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-row" v-if="filteredItems">
                    <div class="form-group col-md-12">
                        <label for="status">Tags</label>
                        <tag
                        v-model="task.tag"
                        :tags="task.tags"
                        @tags-changed="newTags => task.tags = newTags"
                        :autocomplete-items="filteredItems"
                        />
                    </div>
                </div>
                <button class="btn btn-light" @click.prevent="closeModal()">Cancel</button>
                <button v-if="!this.task.id" type="submit" class="btn btn-primary" @click.prevent="submitTask()">Save</button>
                <button v-else type="submit" class="btn btn-primary" @click.prevent="updateTask()">Update</button>
            </form>
        </modal>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'create',
        computed:  {
            ...mapGetters([
                "priorities",
                "statuses",
                "task"
            ]),
            tagItems: {
                get () {
                    return this.$store.getters.tagItems
                },
                set (value) {
                    this.$store.commit('updateTagItems', value)
                }
            },
            filteredItems() {
                return this.tagItems.filter(i => {
                    return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
                });
            }
        },
        async mounted() {
            this.$store.dispatch("fetchFormData")
            this.$store.dispatch("fetchTags")
        },
        data() {
            return {
                tag: '',
                tags: [],
                loadedTags: [],
                autocompleteItems: [],
                form: {},
                errors: {},
            }
        },
        methods: {
            showModal() {
                this.$modal.show('taskModal')
            },
            closeModal() {
                this.$store.commit('updateTask', {})
                this.$modal.hide('taskModal')
            },
            submitTask() {
                axios.post('api/submittask', { 
                    title: this.task.title, 
                    priority: this.task.priority,
                    status: this.task.status,
                    tags: this.task.tags
                    })
                .then(()=>{
                    this.$store.dispatch("fetchTasks")
                    this.$modal.hide('taskModal')
                })
                .catch(error => {
                    console.log(error.response.data)
                    this.errors = error.response.data
                });
            },
            updateTask() {
                axios.post('api/updatetask/'+ this.task.id, { 
                    title: this.task.title, 
                    priority: this.task.priority,
                    status: this.task.status,
                    tags: this.task.tags
                    })
                .then(()=>{
                    this.$store.dispatch("fetchTasks")
                    this.$modal.hide('taskModal')
                    this.$store.commit('updateTask', {})
                })
                .catch(error => {
                    console.log(error.response.data)
                    this.errors = error.response.data
                });
            },
            setSelectedPriority(value) {
                this.$store.commit('updateSelectedPriority', value)
            },
            setSelectedStatus(value) {
                this.$store.commit('updateSelectedStatus', value)
            }
        }
    }
</script>
<style lang="css">
    .vue-tags-input {
        max-width: 100% !important;
    }

    .vue-tags-input .ti-input {
        padding: 4px 10px;
        transition: border-bottom 200ms ease;
        border-radius: 0.25rem;
    }
</style>