<template>
    <div>
        <div class="flex flex-col md:flex-row">
            <div class="flex flex-col items-center  mb-3 md:mb-0 md:mr-5">
                <img :src="comment.user.avatar" width="75" height="75" :alt="comment.user.name">
                <div  v-if="editable || admin" class="flex mt-3 justify-between">
                    <a @click="state = 'editing'" class="no-underline mb-auto text-blue hover:text-blue-dark text-lg" href="javascript:void(0)">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a @click="destroy" class="no-underline ml-3 mb-auto text-red-light hover:text-red text-lg" href="javascript:void(0)">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </div>
            <div v-if="state === 'default'" class="flex flex-col mt-0 w-full justify-between">
                <div class="flex flex-col justify-between mb-1">
                    <p v-html="body" class=" text-grey-darkest leading-normal text-lg"></p>
                </div>
                <div class="ml-1 text-grey-dark leading-normal text-sm">
                    <p>{{comment.user.name}} <span class="mx-1 text-xs">•</span> {{ comment.created_at }}</p>
                </div>
            </div>
           <div v-if="state === 'editing'" class="w-full">
               <form @submit.prevent="submit" action="" method="POST">
                   <textarea v-model="body"
                             name="body"
                             placeholder="Editer mon commntaire..."
                             class="h-24 bg-grey-lighter rounded leading-normal resize-none w-full py-2 px-3">
                   ></textarea>
                   <div v-show="state === 'editing'" class="mt-3 flex justify-end">
                       <button class="border border-green bg-blue text-white hover:bg-blue-dark py-2 px-4 rounded tracking-wide mr-1" type="submit">
                           Enregistrer
                       </button>
                       <button  @click="resetForm" class="border border-red-dark text-red-dark hover:bg-red hover:text-white py-2 px-4 rounded tracking-wide ml-1" type="button">
                           Annuler
                       </button>
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
                axios.put(`${location.pathname}/${this.comment.id}`, this.$data)
                    .then((response) => {
                        this.$emit('updating', response.data);

                        this.state = 'default';
                    });
            },
            destroy() {
                axios.delete(`${location.pathname}/${this.comment.id}`)
                    .then(() => {
                        this.$emit('deleting', {
                            id: this.comment.id,
                        });
                    });
            }
        }
    }
</script>

<style scoped>

</style>
