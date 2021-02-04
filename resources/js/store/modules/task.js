export default {
	actions: {
		async fetchTasks(ctx) {
            ctx.commit('tasksLoading', true)
			const res = await fetch("/api/tasks")
			const tasks = await res.json()

			ctx.commit('updateTasks', tasks.data)
			ctx.commit('tasksLoading', false)
		},
		async fetchTags(ctx) {
			const res = await fetch("/api/tags")
			const tags = await res.json()

			ctx.commit('updateTagItems', tags)
		},
		async fetchFormData(ctx) {
			const res = await fetch("/api/formdata")
			const formData = await res.json()

			ctx.commit('updatePriorities', formData.data.priorities)
			ctx.commit('updateStatuses', formData.data.statuses)
		},
	},
	mutations: {
        tasksLoading(state, loading) {
			state.tasksLoading = loading
		},
		updateTask(state, task) {
			state.task = task
		},
		updateTasks(state, tasks) {
			state.tasks = tasks
		},
		updateTagItems(state, tags) {
			state.tagItems = tags
		},
		updatePriorities(state, priorities) {
			state.priorities = priorities
		},
		updateStatuses(state, statuses) {
			state.statuses = statuses
		},
		updateSelectedPriority(state, priority)
		{
			state.task.priority = priority
		},
		updateSelectedStatus(state, status)
		{
			state.task.status = status
		}
	},
	state: {
        tasksLoading: true,
		tasks: [],
		task: {},
		tagItems: [],
		priorities: [],
		statuses: []
	},
	getters: {
        tasksLoading(state) {
            return state.tasksLoading 
		},
		task(state) {
			return state.task
		},
		tasks(state) {
			return state.tasks
		},
		tagItems(state) {
			return state.tagItems
		},
		priorities(state) {
			return state.priorities
		},
		statuses(state) {
			return state.statuses
		}
	},
}
