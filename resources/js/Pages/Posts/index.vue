<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div v-if="$page.props.user.role=='admin'" class="flex justify-start py-6">
          <inertia-link
            :href="route('posts.create')"
            class="bg-indigo-600 py-2 px-4 rounded-md text-white"
          >
          Create
          </inertia-link>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div
                class="
                  py-2
                  align-middle
                  inline-block
                  min-w-full
                  sm:px-6
                  lg:px-8
                "
              >
                <div
                  class="
                    shadow
                    overflow-hidden
                    border-b border-gray-200
                    sm:rounded-lg
                  "
                >
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th
                          scope="col"
                          class="
                            px-6
                            py-3
                            text-left text-xs
                            font-medium
                            text-gray-500
                            uppercase
                            tracking-wider
                          "
                        >
                        Apartamento
                        </th>
                        <th
                          scope="col"
                          class="
                            px-6
                            py-3
                            text-left text-xs
                            font-medium
                            text-gray-500
                            uppercase
                            tracking-wider
                          "
                        >
                          Nombre
                        </th>
                        <th
                          scope="col"
                          class="
                            px-6
                            py-3
                            text-left text-xs
                            font-medium
                            text-gray-500
                            uppercase
                            tracking-wider
                          "
                        >
                          Aporte
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Show</span>
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Delete</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="(post, index) in postList" :key="index">
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            {{ post.title }}
                          </div>
                        </td>
                        <td
                          class="px-6 py-4 whitespace-nowrap"
                          v-html="post.body"
                        ></td>
                        <td
                          class="
                            px-6
                            py-4
                            whitespace-nowrap
                            text-right text-sm
                            font-medium
                          "
                        >
                          <a
                            href="#"
                            class="text-indigo-600 hover:text-indigo-900"
                            >Show</a
                          >
                        </td>
                        <td
                          class="
                            px-6
                            py-4
                            whitespace-nowrap
                            text-right text-sm
                            font-medium
                          "
                        >
                          <inertia-link
                            :href="route('posts.edit', { id: post.id })"
                            class="text-indigo-600 hover:text-indigo-900"
                            >Edit</inertia-link
                          >
                        </td>
                        <td
                          class="
                            px-6
                            py-4
                            whitespace-nowrap
                            text-right text-sm
                            font-medium
                          "
                        >
                          <a
                            href="#"
                            @click="deletePost(post.id)"
                            class="text-red-600 hover:text-red-900"
                            >Delete</a
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col"></div>
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
import Swal from "sweetalert2";
import axios from 'axios';
import { useAbility } from '@casl/vue';

export default {
  name: "Index",
  components: { AppLayout },
  props: {
    posts: {
      type: Array,
      required: true
    }
  },
  data(){
    return{
      postList: this.$props.posts
    }
  },
  methods: {
    deletePost(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/api/posts/${id}`).then(() => {

            this.postList = this.postList.filter((post) => {
              if(post.id !== id){
                return post;
              }
            })


            Swal.fire("Deleted!", "Your file has been deleted.", "success");
          }).catch(e => console.log(e))
          
        }
      });
    },
  },
  setup() {
    // some code
    const { can } = useAbility();

    return {
      // other props
      can
    };
  }
};
</script>

<style scoped></style>
