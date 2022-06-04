<template>
    <div>
        <h3 class="text-center">Create Task</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addTask">
                    <div class="form-group mb-2">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="task.title">
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            task: {
                title: '',
                user_id: 0,
                checked: false
            }
        }
    },
    methods: {
        addTask() {
            this.axios
                .post('http://localhost:8000/api/tasks', this.task)
                .then(response => (
                    this.$router.push({ name: 'home' })
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>
