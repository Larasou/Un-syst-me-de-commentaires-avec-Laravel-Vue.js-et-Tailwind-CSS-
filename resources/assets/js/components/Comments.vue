<template>
    <div class="bg-grey-lightest font-open-sans max-w-3xl mx-auto">
        <div class="bg-white rounded shadow-sm p-8 mb-4">
            <div class="mb-4">
                <h3 class="text-black">Commentaires</h3>
            </div>

            <form @submit.prevent="submit" action="" method="POST">
                   <textarea v-model="body"
                             name="body"
                             placeholder="Ajouter un commntaire..."
                             class="bg-grey-lighter rounded leading-normal resize-none w-full py-2 px-3"
                             :class="[state === 'editing' ? 'h-24' : 'h-10']"
                             @focus="startEditing">
                   ></textarea>
                <div v-show="state === 'editing'" class="mt-3 flex justify-end">
                    <button class="border border-green bg-green text-white hover:bg-green-dark py-2 px-4 rounded tracking-wide mr-1" type="submit">
                        Enregistrer
                    </button>
                    <button  @click="stopEditing" class="border border-orange-dark text-orange-dark hover:bg-orange hover:text-white py-2 px-4 rounded tracking-wide ml-1" type="button">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
        <div v-for="(comment, index) in comments" :key="comment.id">
            <comment :comment="comment"
                     @updating="updated"
                     @deleting="deleted"
                     :class="[index === comments.length - 1 ? '' : 'mb-6']"
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
                state: 'default',
                comments: {},
                body: null
            }
        },
        created() {
            this.fetch();
        },
        components: { Comment },
        methods: {
            fetch() {
              axios.get(location.pathname + '/comments')
                  .then((response) => {
                      this.comments = response.data;
                  })
            },
            startEditing() {
                this.state = 'editing';
            },
            stopEditing() {
                this.state = 'default';
                this.body = null;
            },
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
                axios.post(location.pathname + '/comments', this.$data)
                    .then((response) => {
                        this.comments.unshift(response.data);
                        this.stopEditing();
                    });
            }
        }
    }
</script>

<style scoped>

</style>
