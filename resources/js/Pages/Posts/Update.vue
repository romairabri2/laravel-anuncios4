<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create</h2>
    </template>
     <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <article class="p-10">
                  <h2 class="text-3xl font-bold pb-6">Update Post</h2>
                  <form @submit.prevent ="updatePost">
                    <Label class="text-2xl">Title</Label>
                    <Input ref="title" v-model="form.title" class="w-1/2 my-3" type="text" required placeholder="Title..." />
                    <InputError :message="form.errors.title"/>

                    <Label class="text-2xl mb-3">Body</Label>
                    <QuillEditor ref="body" v-model:content="form.body" contentType="html" required toolbar="full" theme="snow" />
                    <InputError :message="form.errors.body"/>

                    <Button class="mt-6">Update</Button>
                  </form>
                </article>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout";
import Label from "@/Jetstream/Label";
import Input from "@/Jetstream/Input";
import Button from "@/Jetstream/Button";
import InputError from "@/Jetstream/InputError";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

import axios from 'axios';

export default {
  name: "Update",
  components: { Button, Input, InputError, Label, AppLayout, QuillEditor },
  props:['post'],
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        title: this.$props.post.title,
        body: this.$props.post.body
      })
    }
  },
  methods: {
    updatePost(){
      this.form.post(route('posts.update', {id: this.post.id }), {
        onSuccess: () => {
           this.form.reset()
           this.$inertia.router.push('/posts')
         },
        onError: () => {
            if(this.form.errors.title){
                this.form.reset('title', 'title')
                this.$refs.title.focus()
            }
        }
      })
      
    },  
  }
};
</script>

<style scoped>
</style>
