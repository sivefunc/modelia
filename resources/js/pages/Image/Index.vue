<template>
  <Header/>
    <div class="flex flex-col items-center mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
      <header class="text-center">
        <h2 class="text-xl font-bold text-pink-900 sm:text-3xl">Personal Collection</h2>
        <p class="mx-auto mt-4 max-w-md text-gray-500">
          These are the Images that you have generated in our platform
        </p>
      </header>
      <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <li v-for="image in images" class="shadow-xl shadow-pink-500/20">
          <Link :href="'/image/' + image.link " class="group block overflow-hidden">
            <img
              :src="image.attachment"
              alt=""
              class="h-[250px] w-[250px] object-cover transition duration-500 group-hover:scale-105 sm:h-[250px]"
            />
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
