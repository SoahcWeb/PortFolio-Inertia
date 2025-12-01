<template>
  <div class="landing-page">
    <!-- Bouton Entrer pour les visiteurs -->
    <button class="btn-enter" @click="goToFront">
      <img src="/images/entrer.png" alt="Entrer" />
    </button>

    <!-- Bouton Admin en haut à droite -->
    <button class="btn-admin" @click="goToLogin">
      <img src="/images/admin.png" alt="Admin" />
    </button>
  </div>
</template>

<script>
export default {
  name: "LandingPage",
  methods: {
    goToFront() {
      this.$inertia.visit('/home'); // Page principale frontoffice
    },
    goToLogin() {
      this.$inertia.visit('/login'); // Page login admin
    }
  }
}
</script>

<style scoped>
.landing-page {
  background-image: url('/images/landing-bg.jpg');
  background-size: cover;
  background-position: center;
  height: 100vh;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: flex-end; /* Bouton Entrer en bas */
  padding-bottom: 20px; /* Encore plus bas */
}

/* Bouton Entrer */
.btn-enter {
  padding: 0;
  border: none;
  background: transparent;
  cursor: pointer;
}

.btn-enter img {
  width: 252px; /* 30% plus petit que 360px */
  height: auto;
}

/* Bouton Admin */
.btn-admin {
  position: absolute;
  top: 20px;
  right: 20px;
  padding: 0;
  border: none;
  background: transparent;
  cursor: pointer;
}

.btn-admin img {
  width: 111px;
  height: 111px;
}
</style>
