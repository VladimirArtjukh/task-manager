<template>
    <div class="container py-4">
        <h1 class="mb-4">Task Manager</h1>

        <!-- Task Creation Form -->
        <form @submit.prevent="addTask" class="mb-4 card p-3">
            <div class="mb-3">
                <input
                    v-model="newTask.title"
                    class="form-control"
                    placeholder="Task Title"
                    required
                >
            </div>
            <div class="mb-3">
        <textarea
            v-model="newTask.description"
            class="form-control"
            placeholder="Description"
            rows="3"
            required
        ></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>

        <!-- Task List -->
        <div class="task-list">
            <div
                v-for="task in tasks"
                :key="task.id"
                class="task-item card mb-3 shadow-sm"
            >
                <div class="card-body">
                    <h5
                        class="card-title mb-2"
                        :class="{ 'completed': task.is_completed }"
                    >
                        {{ task.title }}
                    </h5>
                    <p class="card-text text-muted">{{ task.description }}</p>

                    <div class="btn-group" role="group">
                        <button
                            @click="toggleComplete(task)"
                            :class="[
                'btn',
                'btn-sm',
                task.is_completed ? 'btn-outline-success' : 'btn-success'
              ]"
                        >
                            {{ task.is_completed ? 'Undo' : 'Complete' }}
                        </button>
                        <button
                            @click="editTask(task)"
                            class="btn btn-sm btn-warning"
                        >
                            Edit
                        </button>
                        <button
                            @click="deleteTask(task)"
                            class="btn btn-sm btn-danger"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            <div v-if="!tasks.length" class="alert alert-info">
                No tasks yet. Add some tasks to get started!
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, inject } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const $route = inject('$route'); // Inject the route function

        // Reactive data
        const tasks = ref([]);
        const newTask = ref({
            title: '',
            description: ''
        });
        const editingTask = ref(null);

        // Methods
        const fetchTasks = async () => {
            const response = await axios.get($route('tasks.index'));
            tasks.value = response.data.data;
        };

        const addTask = async () => {
            try {
                const response = await axios.post($route('tasks.store'), newTask.value);
                tasks.value.push(response.data.data);
                newTask.value = { title: '', description: '' };
            } catch (error) {
                console.error(error);
            }
        };

        const toggleComplete = async (task) => {
            const response = await axios.post($route('tasks.toggle', { task: task.id }));
            task.is_completed = response.data.data.is_completed;
        };

        const deleteTask = async (task) => {
            await axios.delete($route('tasks.destroy', { task: task.id }));
            tasks.value = tasks.value.filter(t => t.id !== task.id);
        };

        const editTask = async (task) => {
            const updatedTask = {
                title: prompt('Enter new title', task.title),
                description: prompt('Enter new description', task.description)
            };
            if (updatedTask.title && updatedTask.description) {
                const response = await axios.put($route('tasks.update', { task: task.id }), updatedTask);
                Object.assign(task, response.data.data);
            }
        };

        // Lifecycle hook
        onMounted(fetchTasks);

        // Return everything needed in the template
        return {
            tasks,
            newTask,
            editingTask,
            fetchTasks,
            addTask,
            toggleComplete,
            deleteTask,
            editTask
        };
    }
}
</script>

<style scoped>
/* Additional component-specific styles can go here */
.card {
    border-radius: 0.5rem;
}

.btn-group .btn {
    margin-right: 0.25rem;
}
</style>
