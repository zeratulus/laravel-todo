<template>
    <div>
        <h3 class="text-center">Edit Task</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateTask">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="task.title">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
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
    created() {
        this.axios
            .get(`http://localhost:8000/api/tasks/${this.$route.params.id}`)
            .then((res) => {
                this.product = res.data;
            });
    },
    methods: {
        updateTask() {
            this.axios
                .patch(`http://localhost:8000/api/tasks/${this.$route.params.id}`, this.task)
                .then((res) => {
                    this.$router.push({ name: 'home' });
                });
        }
    }
}
</script>
