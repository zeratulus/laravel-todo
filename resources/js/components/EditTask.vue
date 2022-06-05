<template>
    <div>
        <h3 class="text-center">Edit Task</h3>
        <div class="row">
            <div class="col-sm-12">

                <div v-if="isLoading" class="d-flex justify-content-center">
                    <div class="spinner-grow" role="status"></div>
                </div>

                <form v-if="!isLoading" @submit.prevent="updateTask">
                    <div class="form-group">
                        <label for="input-title">Title</label>
                        <input type="text" class="form-control" v-model="task.title" id="input-title">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" v-model="task.checked" id="input-checked">
                        <label class="form-check-label" for="input-checked">Checked</label>
                    </div>

                    <div class="d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-primary">Update</button>
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
            },
            isLoading: true,
        }
    },
    created() {
        this.axios
            .get(`http://localhost:8000/api/tasks/${this.$route.params.id}`)
            .then((res) => {
                this.task = res.data;
                this.isLoading = false;
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
