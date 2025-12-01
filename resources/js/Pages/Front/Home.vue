<script setup>
import { Head } from '@inertiajs/vue3';
import FrontLayout from '@/Pages/Front/FrontLayout.vue';
import { ref, onMounted, nextTick } from 'vue';

const bannerCards = [
  { id: 1, title: 'À propos', description: 'Découvrez mon univers et mon parcours.', image: '/images/photo.jpg', link: '/a-propos' },
  { id: 2, title: 'Mes Projets', description: 'Nouveautés & réalisations', image: '/images/project-icon.png', link: '/projets' },
  { id: 3, title: 'Nethra.AI', description: 'Innovation & IA', image: '/images/nethra-icon.png', link: '/nethra' },
  { id: 4, title: 'A venir : Musique.AI & Roman', description: 'Projets futurs', image: '/images/future-icon.png', link: '/coming-soon' },
];

const carouselRef = ref(null);
const currentIndex = ref(0);
const cardWidth = 720;
const cardMargin = 16;

let autoplayInterval;
onMounted(() => {
  nextTick(() => {
    scrollToIndex(currentIndex.value);
    autoplayInterval = setInterval(() => next(), 5000);
  });
});

function next() {
  currentIndex.value = (currentIndex.value + 1) % bannerCards.length;
  scrollToIndex(currentIndex.value);
}

function prev() {
  currentIndex.value = (currentIndex.value - 1 + bannerCards.length) % bannerCards.length;
  scrollToIndex(currentIndex.value);
}

function scrollToIndex(index) {
  if (!carouselRef.value) return;
  const container = carouselRef.value;
  const scrollPosition = index * (cardWidth + cardMargin * 2);
  container.scrollTo({
    left: scrollPosition,
    behavior: 'smooth',
  });
}

function onScroll() {
  if (!carouselRef.value) return;
  const container = carouselRef.value;
  const containerCenter = container.offsetWidth / 2;

  for (let i = 0; i < container.children.length; i++) {
    const child = container.children[i].querySelector('.content-inner');
    const rect = container.children[i].getBoundingClientRect();
    const childCenter = rect.left + rect.width / 2 - container.getBoundingClientRect().left;
    const distance = containerCenter - childCenter;

    const absDistance = Math.abs(distance);
    const scale = absDistance < 360 ? 0.9 : 0.7; // Cadre central réduit de 10% vs cadre normal
    const rotateY = Math.max(Math.min(distance / 10, 30), -30);
    const opacity = absDistance < 360 ? 1 : 0.5;

    child.style.transform = `scale(${scale}) rotateY(${rotateY}deg)`;
    container.children[i].style.opacity = opacity;

    // Glow violet dynamique #C96BFF
    if (absDistance < 360) {
      child.style.boxShadow = `0 0 40px 10px rgba(201,107,255,0.45)`;
    } else {
      child.style.boxShadow = 'none';
    }
  }
}
</script>

<template>
  <FrontLayout>
    <Head title="Portfolio" />

    <!-- Séparateur avant Hero -->
    <div class="w-full h-2 bg-gradient-to-r from-[#0F0F2F] via-[#0F4F8F] to-[#0F0F2F]"></div>

    <!-- Hero + Carousel -->
    <section class="relative py-16 overflow-hidden">
      <!-- Background -->
      <div class="absolute inset-0 z-0 bg-center bg-cover" style="background-image: url('/images/scroll-bg.jpg');"></div>
      <div class="absolute inset-0 bg-black/50 z-5"></div>

      <!-- Carousel container -->
      <div
        ref="carouselRef"
        class="relative z-10 flex space-x-4 overflow-x-auto carousel snap-x snap-mandatory perspective-1000"
        @scroll="onScroll"
        :style="{ paddingLeft: 'calc(50vw - 360px)', paddingRight: 'calc(50vw - 360px)'}"
      >
        <div
          v-for="(card, index) in bannerCards"
          :key="card.id"
          class="flex-shrink-0 transition-all duration-500 cursor-pointer snap-center"
          @click="window.location.href = card.link"
        >
          <!-- Carte avec glow violet -->
          <div
            class="content-inner relative flex flex-col items-center justify-center text-center w-[720px] h-[404px] p-8
                   bg-[#0F0F2F]/70 rounded-xl shadow-md transition-transform duration-500
                   ring-4 ring-[#0F0F2F]/30 hover:ring-[#C96BFF] will-change-transform"
          >
            <img v-if="card.image" :src="card.image" class="object-contain w-40 h-40 mb-4" />
            <h3 class="text-3xl font-bold text-[#C96BFF] mb-2">{{ card.title }}</h3>
            <p class="text-[#E0E6F0] text-lg">{{ card.description }}</p>
          </div>
        </div>
      </div>

      <!-- Navigation -->
      <button class="absolute left-4 top-1/2 -translate-y-1/2 text-[#C96BFF] text-3xl font-bold z-20" @click="prev">&#8249;</button>
      <button class="absolute right-4 top-1/2 -translate-y-1/2 text-[#C96BFF] text-3xl font-bold z-20" @click="next">&#8250;</button>

      <!-- Pagination -->
      <div class="absolute z-20 flex justify-center w-full gap-4 bottom-4">
        <span
          v-for="(card, index) in bannerCards"
          :key="card.id"
          class="w-4 h-4 transition-colors rounded-full"
          :class="index === currentIndex ? 'bg-[#C96BFF]' : 'bg-[#C96BFF]/50'"
        ></span>
      </div>
    </section>

    <!-- Séparateur après Hero -->
    <div class="w-full h-2 bg-gradient-to-r from-[#0F0F2F] via-[#0F2F4F] to-[#0F0F2F]"></div>

    <!-- Section 4 cartes semi-transparentes -->
    <section class="px-12 py-20 bg-[#0F0F2F]/70 rounded-xl max-w-7xl mx-auto space-y-20">
      <div
        v-for="(card, index) in bannerCards"
        :key="card.id"
        class="flex flex-col items-center justify-between md:flex-row md:space-x-12"
        :class="index % 2 === 0 ? '' : 'md:flex-row-reverse'"
      >
        <img :src="card.image" class="object-contain w-48 h-48" />
        <p class="text-[#E0E6F0] text-center md:text-left md:max-w-2xl text-lg">{{ card.description }}</p>
      </div>
    </section>
  </FrontLayout>
</template>

<style scoped>
.perspective-1000 {
  perspective: 1000px;
}

/* Cacher scrollbar */
.carousel::-webkit-scrollbar {
  display: none;
}
.carousel {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

/* Glow pulsante possible */
@keyframes glowPulse {
  0% { box-shadow: 0 0 40px 10px rgba(201,107,255,0.35); }
  50% { box-shadow: 0 0 60px 20px rgba(201,107,255,0.5); }
  100% { box-shadow: 0 0 40px 10px rgba(201,107,255,0.35); }
}
</style>
