<template>
  <Header/>
    <div class="flex flex-1 w-full h-screen flex-col items-center justify-center text-center px-4 py-20 bg-gradient-to-r from-pink-50/50 via-pink-50 to-pink-50/50 dark:from-gray-800 dark:via-gray-700 dark:to-gray-800">
  <h1
    class="mx-auto max-w-4xl font-display text-5xl font-bold tracking-normal text-white-300 dark:text-gray-300 sm:text-7xl">
    Revolutionize Your Generation
    <span class="relative whitespace-nowrap text-white-600 dark:text-gray-300">Of Ideas</span>
    <span class="relative whitespace-nowrap text-pink-500 dark:text-pink-300">
      <svg aria-hidden="true" viewBox="0 0 418 42" class="absolute top-2/3 left-0 h-[0.58em] w-full fill-pink-500 dark:fill-pink-300/60" preserveAspectRatio="none">
        <path d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.780 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.540-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.810 23.239-7.825 27.934-10.149 28.304-14.005 .417-4.348-3.529-6-16.878-7.066Z"></path>
      </svg>
      <span class="ml-5 relative">with AI</span>
    </span>
  </h1>
  <h2 class="mx-auto mt-12 max-w-xl text-lg sm:text-white-400 text-white-500 dark:text-gray-300 leading-7">
    Experience the creation of new creative ideas of with our cutting-edge AI Image Generation Tool, where each image tries to match that with great accuracy.
  </h2>
  <Link class="bg-pink-600 dark:bg-gray-800 rounded-xl text-white dark:text-gray-300 font-medium px-4 py-3 sm:mt-10 mt-8 hover:bg-pink-500 dark:hover:bg-gray-600 transition"
    href="/image/create">Get started</Link>
</div>

  <Footer/>
</template>

<script>
import Footer from '@/Shared/Footer.vue';
import Header from '@/Shared/Header.vue';
import { Link } from '@inertiajs/vue3'
export default {
  components: {
    Footer,
    Header,
    Link,
  },
};
</script>
