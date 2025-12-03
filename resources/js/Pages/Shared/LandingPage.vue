<template>
  <div class="landing-page">
    <!-- Video Background -->
    <video autoplay muted loop playsinline class="bg-video">
      <source src="/videos/landing-bg.mp4" type="video/mp4" />
    </video>

    <!-- Overlay sombre -->
    <div class="overlay"></div>

    <!-- Bouton Entrer pour les visiteurs -->
    <button class="btn-enter" @click="goToFront">
      <img src="/images/entrer.png" alt="Entrer" />
    </button>
  </div>
</template>

<script>
export default {
  name: "LandingPage",
  methods: {
    goToFront() {
      this.$inertia.visit('/home');
    }
  }
}
</script>

<style scoped>
/* Container principal */
.landing-page {
  height: 100vh;
  width: 100%;
  position: relative;
  overflow: hidden;
}

/* Video en full screen avec léger mouvement/flou */
.bg-video {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -2;
  filter: brightness(0.9) blur(1px);
  transform: scale(1.02);
  animation: subtle-move 20s infinite alternate ease-in-out;
}

@keyframes subtle-move {
  0% { transform: scale(1.02) translate(0, 0); }
  50% { transform: scale(1.03) translate(-10px, 5px); }
  100% { transform: scale(1.02) translate(0, 0); }
}

/* Overlay sombre */
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.35);
  z-index: -1;
}

/* Bouton Entrer cercle parfait avec pulsation */
.btn-enter {
  position: absolute;
  bottom: calc(20px + 1.5cm);
  right: calc(20px + 1.5cm);
  width: 240px;
  height: 240px;
  padding: 0;
  border: 2px solid transparent; /* invisible par défaut */
  border-radius: 50%;
  background: transparent;
  cursor: pointer;
  z-index: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  animation: pulse 4s infinite alternate ease-in-out; /* seulement pulsation */
  transition: transform 0.3s ease, border 0.3s ease, box-shadow 0.3s ease;
}

.btn-enter img {
  width: 98%; /* image proche de la bordure */
  height: auto;
  display: block;
  pointer-events: none;
}

/* Hover violet néon avec bordure et glow léger */
.btn-enter:hover {
  border-color: #C96BFF; /* apparait uniquement au hover */
  box-shadow: 0 0 8px rgba(201,107,255,0.25);
  transform: scale(1.1);
}

/* Pulsation continue */
@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .btn-enter {
    width: 180px;
    height: 180px;
  }
  .btn-enter img {
    width: 75%;
  }
}

@media (max-width: 480px) {
  .btn-enter {
    width: 150px;
    height: 150px;
  }
  .btn-enter img {
    width: 75%;
  }
}
</style>
