<template>
  <Toaster />
  <Header/>
  <main class="flex justify-center items-center h-screen">
    <div class="p-8 max-w-lg border border-pink-300 rounded-2xl hover:shadow-xl hover:shadow-pink-50 flex flex-col justify-center items-center">
      <div class="flex mb-5 w-full space-x-5">
        <input
          type="text"
          id="image-prompt"
          placeholder="A cat with a red hat"
          class="grow-[75] inline-flex mt-1 p-2 rounded-lg border-gray-300 focus:ring-pink-500 focus:border-pink-500 shadow-sm"
          v-model="form.prompt"
        />
        <button @click="submit" class="grow-[25] bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded-md">
          Draw Now
        </button>
      </div>
      <img :src="$page.props.flash.image_url ? $page.props.flash.image_url : url" class="shadow rounded-lg" >
      <div class="relative inline-block text-left">
        <div>
          <button type="button" @click="dropdown_menu" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 shadow-xs ring-gray-300 ring-inset hover:bg-gray-100" id="menu-button" aria-expanded="true" aria-haspopup="true">
            Generative Model: {{form.model ? form.model : models[0].name}}
          </button>
        </div>
      <div :class="[isDropdownHidden ? 'hidden' : '', 'absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white ring-1 shadow-lg ring-black/5 focus:outline-hidden']" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div v-for="(model, idx) in models" class="py-1" role="none">
          <MenuItem @click="dropdown_menu" :id="'menu-item-' + idx">{{model.name}}</MenuItem>
        </div>
      </div>
    </div>
    </div>
  </main>
  <Footer/>
</template>

<script>
import Footer from '@/Shared/Footer.vue';
import Header from '@/Shared/Header.vue';
import MenuItem from '@/Shared/MenuItem.vue';
import { router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'
import { Toaster } from '@/components/ui/toast'
import { useToast } from '@/components/ui/toast/use-toast'

export default {
  props: ['models', 'url', 'flash'],
  components: {
    Footer,
    Header,
    MenuItem,
    router,
    Toaster,

  },

  setup () {
    const { toast } = useToast();
    const page = usePage();
    return {page, toast};
  },

  data () {
    return {
      isDropdownHidden: true,
      form: {
        model: null,
        prompt: null
      }
    }
  },

  watch: {
    'flash.toast'(newValue) {
      if (this.page.props.flash.toast) {
        this.toast({
          title: this.page.props.flash.toast.title,
          description: this.page.props.flash.toast.description,
          variant: this.page.props.flash.toast.variant
        });
      }
    }
  },

  methods: {
    dropdown_menu(event) {
      this.isDropdownHidden = !this.isDropdownHidden;
      if (event && event.target.role == "menuitem") {
        this.form.model = event.target.innerHTML;
      }
    },
    submit() {
      if (!this.form.model) {
        this.form.model = this.models[0].name;
      }

      if (!this.form.prompt) {
        this.form.prompt = "A cat with a red hat";
      }
      router.post('/image/store', this.form)
    }
  },
};
</script>
