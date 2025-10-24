<script setup lang="ts">
import { dashboard, login, register, home } from '@/routes';
import { officesIndex } from '@/routes/offices';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const isAuthenticated = computed(() => page.props.auth?.user);
</script>

<template>
  <Head title="Welcome" />

  <div class="min-h-screen flex flex-col bg-gray-50">

    <!-- Top Navigation Bar -->
    <header class="bg-gradient-to-r from-blue-800 to-blue-900 text-white shadow-md">
      <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
        <h1 class="text-2xl font-extrabold tracking-tight">
          <span class="text-yellow-300">E-</span><span class="text-white">CHO</span>
        </h1>

        <nav class="flex items-center space-x-6 text-sm font-medium">
          <Link :href="home()" class="hover:text-yellow-300 transition">Home</Link>
          <Link :href="officesIndex()" class="hover:text-yellow-300 transition">Offices</Link>

          <template v-if="isAuthenticated">
            <Link
              :href="dashboard()"
              class="rounded-lg bg-yellow-300 text-blue-900 px-4 py-2 font-semibold shadow hover:bg-yellow-400 transition"
            >
              Dashboard
            </Link>
          </template>

          <template v-else>
            <Link
              :href="login()"
              class="hover:text-yellow-300 transition"
            >
              Log in
            </Link>
            <Link
              :href="register()"
              class="rounded-lg bg-yellow-300 text-blue-900 px-4 py-2 font-semibold shadow hover:bg-yellow-400 transition"
            >
              Register
            </Link>
          </template>
        </nav>
      </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-1 flex flex-col items-center justify-center text-center px-6 py-20 relative overflow-hidden">
      <!-- Background Accent -->
      <div
        class="absolute inset-0 opacity-10 bg-[url('/images/pattern-light.svg')] bg-center bg-cover pointer-events-none"
      ></div>

      <div class="relative z-10 max-w-3xl">
        <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-800 mb-4 leading-tight">
          Empowering <span class="text-blue-700">Citizens</span> for a Better
          <span class="text-blue-700">Public Service</span>
        </h1>

        <p class="text-gray-600 text-lg mb-10">
          Share feedback, track service improvements, and help build a more transparent and efficient government.
        </p>

        <div class="flex flex-wrap justify-center gap-4">
          <Link
            :href="register()"
            class="bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold text-lg shadow hover:bg-blue-800 transition"
          >
            Get Started
          </Link>
          <Link
            :href="login()"
            class="border border-blue-700 px-6 py-3 rounded-xl font-semibold text-lg text-blue-700 hover:bg-blue-50 transition"
          >
            Log In
          </Link>
        </div>
      </div>
    </main>

    <!-- Info Section (like Offices layout) -->
    <section class="px-6 pb-16">
      <div class="max-w-6xl mx-auto rounded-2xl border border-gray-200 bg-white shadow-lg p-10 text-center">
        <h2 class="text-2xl font-semibold text-gray-800 mb-3">Welcome to <span class="text-blue-700">E-CHO</span></h2>
        <p class="text-gray-600 mb-8">
          Your centralized platform for communication, transparency, and feedback between citizens and
          government offices of Sta. Maria, Bulacan.
        </p>

        <Link
          :href="officesIndex()"
          class="rounded-lg bg-blue-700 px-5 py-2 text-white font-medium shadow hover:bg-blue-800 transition"
        >
          Explore Offices Directory
        </Link>
      </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 text-sm text-gray-500 border-t border-gray-200">
      &copy; 2025 <span class="font-semibold text-blue-700">E-CHO</span>. All rights reserved.
    </footer>
  </div>
</template>
