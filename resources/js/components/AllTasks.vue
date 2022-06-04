<template>
    <div>
        <h2 class="text-center">ToDo`s List</h2>

        <table class="table" v-if="!isLoading">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Created</th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody>
            <tr v-for="task in tasks" :key="task.id">
                <td>{{ task.id }}</td>
                <td>{{ task.title }}</td>
                <td>{{ task.created_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: task.id }}" class="btn btn-success">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteTask(task.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <div v-if="isLoading" class="d-flex justify-content-center">
            <div class="spinner-grow" role="status"></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tasks: [],
            isLoading: true
        }
    },
    created() {
        this.isLoading = true;
        this.axios
            .get('http://localhost:8000/api/tasks/')
            .then(response => {
                this.tasks = response.data;
                this.isLoading = false;
            });
    },
    methods: {
        deleteTask(id) {
            this.axios
                .delete(`http://localhost:8000/api/tasks/${id}`)
                .then(response => {
                    let i = this.tasks.map(data => data.id).indexOf(id);
                    this.tasks.splice(i, 1)
                });
        }
    }
}
</script>
