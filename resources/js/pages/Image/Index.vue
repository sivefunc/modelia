<template>
  <Header/>
    <div class="flex flex-col items-center px-4 py-8 sm:px-6 sm:py-12 lg:px-8 bg-gradient-to-r from-pink-50/50 via-pink-50 to-pink-50/50 dark:from-gray-800 dark:via-gray-700 dark:to-gray-800">
      <header class="text-center">
        <h2 class="text-xl font-bold text-pink-900 sm:text-3xl">Personal Collection</h2>
        <p class="mt-4 text-gray-500">
          These are the Images that you have generated in our platform
        </p>
      </header>
      <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <li v-for="image in images" class="shadow-xl shadow-pink-500/20">
          <Link :href="'/image/' + image.link" class="group w-[200px] h-[200px] relative block ">
            <img
              alt=""
              :src="image.attachment"
              class="absolute inset-0 h-full w-full object-scale-down transition-opacity group-hover:opacity-75"
              />
            <div class="relative">
              <div class="p-4">
                <div
                  class="translate-y-8 transform opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100"
                >
                  <p class="text-xl text-black text-outline">
                    {{image.prompt}}
                  </p>
                </div>
              </div>
            </div>
          </Link>
        </li>
      </ul>
    </div>

  <Footer/>

</template>

<script>
import Footer from '@/Shared/Footer.vue';
import Header from '@/Shared/Header.vue';
import { Link } from '@inertiajs/vue3'
export default {
  props: ['images', 'flash'],
  components: {
    Footer,
    Header,
    Link
  }
}
</script>
