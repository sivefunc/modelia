<template>
  <header class="bg-pink-50">
    <div class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8">
      <Link class="flex space-x-5 text-pink-600" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-5.043-.025a15.994 15.994 0 0 1 1.622-3.395m3.42 3.42a15.995 15.995 0 0 0 4.764-4.648l3.876-5.814a1.151 1.151 0 0 0-1.597-1.597L14.146 6.32a15.996 15.996 0 0 0-4.649 4.763m3.42 3.42a6.776 6.776 0 0 0-3.42-3.42" />
        </svg>
        <span class="inline-flex font-medium text-lg">Modelia</span>
      </Link>
      <div class="flex flex-1 items-center justify-end">
        <div class="flex items-center gap-4">
          <div v-if="$page.props.auth.user" class="sm:flex sm:gap-4">
            <Link
              class="block rounded-md bg-pink-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-pink-700"
              href="/image/index"
            >
            Images
            </Link>
            <Link
              class="block rounded-md bg-pink-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-pink-700"
              href="/image/create"
            >
            Create
            </Link>

            <Link
              class="block rounded-md bg-pink-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-pink-700"
              href="/logout"
              method="post"
            >
              Log out
            </Link>
          </div>

          <div v-else class="sm:flex sm:gap-4">
            <Link
              class="block rounded-md bg-pink-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-pink-700"
              href="/login"
            >
              Login
            </Link>

            <Link
              class="hidden rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-pink-600 transition hover:text-pink-600/75 sm:block"
              href="/register"
            >
              Register
            </Link>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { Link } from '@inertiajs/vue3'
export default {
  components: {
    Link
  }
}

</script>
