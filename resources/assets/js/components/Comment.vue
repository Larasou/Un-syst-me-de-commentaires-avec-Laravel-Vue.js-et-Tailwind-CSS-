<template>
    <div>
        <div>
           <div v-if="state === 'default'">
               <div v-text="body"></div>
               <div class="text-secondary text-xs ml-3">
                   <span v-text="comment.user.name"></span> -
                   <span v-text="comment.created_at"></span>
                   <button v-if="editable" @click="state = 'editing'" class="text-green font-bold no-underline">
                       Editer
                   </button>
                   <button v-if="editable" @click="destroy" class="text-red font-bold no-underline">
                       Supprimer
                   </button>
               </div>
           </div>
           <div v-if="state === 'editing'">
               <form @submit.prevent="submit" action="" method="POST">
                   <textarea v-model="body"
                             name="body"
                             placeholder="Mon commntaire..."
                             class="border"
                   ></textarea>
                   <div>
                       <button type="submit">Enregistrer</button>
                       <button @click="resetForm" type="button">Annuler</button>
                   </div>
               </form>
           </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Comment",
        props: ['comment'],
        data () {
            return {
                state: 'default',
                body: this.comment.body,
            }
        },
        computed: {
            editable() {
                return this.user.id === this.comment.user.id;
            }
        },
        methods: {
            resetForm() {
                this.state = 'default';
                this.body = this.comment.body;
            },
            submit() {
                this.state = 'default';
                this.$emit('updating', {
                    'id': this.comment.id,
                    'body': this.body,
                });
            },
            destroy() {
                this.$emit('deleting', {
                    'id': this.comment.id,
                });
            }
        }
    }
</script>

<style scoped>

</style>
