<template>
    <div>
        <div>
            <form @submit.prevent="submit" action="" method="POST">
                   <textarea v-model="body"
                             name="body"
                             placeholder="Mon commntaire..."
                             class="border"
                   ></textarea>
                <div>
                    <button type="submit">Enregistrer</button>
                    <button type="reset">Annuler</button>
                </div>
            </form>
        </div>
        <div v-for="comment in comments" :key="comment.id">
            <comment :comment="comment"
                     @updating="updated"
                     @deleting="deleted"
            ></comment>
        </div>
    </div>
</template>

<script>
    import Comment from './Comment';

    export default {
        name: "Comments",
        data() {
            return {
                comments: [
                    {
                        id: 1,
                        body: "Hey! Je m'appelle Soulouf et toi ?",
                        edited: false,
                        created_at: new Date().toLocaleString(),
                        user: {
                            id: 1,
                            name: 'Soulouf',
                        }
                    },
                    {
                        id: 2,
                        body: "C'est moi ou il fait très chaud ce temps ci ?",
                        edited: false,
                        created_at: new Date().toLocaleString(),
                        user: {
                            id: 2,
                            name: 'Jean',
                        }
                    },
                    {
                        id: 3,
                        body: "Ha oui il fait super chaud!",
                        edited: false,
                        created_at: new Date().toLocaleString(),
                        user: {
                            id: 1,
                            name: 'Soulouf',
                        }
                    },
                ],
                body: null
            }
        },
        components: { Comment },
        methods: {
            updated ($event) {
                let index = this.comments.findIndex((element) => {
                    return element.id === $event.id;
                });

                this.comments[index].body = $event.body;
            },
            deleted ($event) {
                let index = this.comments.findIndex((element) => {
                    return element.id === $event.id;
                });

                this.comments.splice(index, 1);
            },
            submit() {
                let newComment = {
                    id: this.comments[this.comments.length - 1].id + 1,
                    body: this.body,
                    edited: false,
                    created_at: new Date().toLocaleString(),
                    user: {
                        id: this.user.id,
                        name: this.user.name,
                    }
                }

                this.comments.push(newComment);

                this.body = null;
            }
        }
    }
</script>

<style scoped>

</style>
