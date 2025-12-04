<template>
  <footer class="bg-[#0F0F2F] shadow-inner mt-8 p-8">
    <div class="flex flex-col justify-center gap-8 mx-auto md:flex-row max-w-7xl">

      <!-- Colonne 1 : Réseaux Sociaux -->
      <div class="flex-1 flex flex-col items-center justify-start gap-2 text-center border-b md:border-b-0 md:border-r border-[#0F4F8F] pb-4 md:pb-0 md:pr-4">
        <p class="font-semibold text-[#52c5ff]">Suivez-moi :</p>
        <div class="flex gap-4 mt-2">
          <!-- LinkedIn -->
          <a href="https://linkedin.com" target="_blank" class="p-2 rounded border-2 border-transparent text-[#0F4F8F] hover:border-[#C96BFF] transition-all duration-300 hover:shadow-[0_0_15px_rgba(201,107,255,0.45)]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8">
              <path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM0 8h5V24H0V8zm7.5 0h4.7v2.1h.1c.65-1.2 2.25-2.5 4.6-2.5 4.9 0 5.8 3.2 5.8 7.3V24h-5V14.4c0-2.3-.05-5.2-3.15-5.2-3.15 0-3.65 2.5-3.65 5.05V24h-5V8z"/>
            </svg>
          </a>

          <!-- GitHub -->
          <a href="https://github.com" target="_blank" class="p-2 rounded border-2 border-transparent text-[#0F4F8F] hover:border-[#C96BFF] transition-all duration-300 hover:shadow-[0_0_15px_rgba(201,107,255,0.45)]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8">
              <path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.387.6.113.82-.262.82-.583 0-.288-.012-1.244-.018-2.256-3.338.726-4.042-1.61-4.042-1.61-.546-1.387-1.333-1.756-1.333-1.756-1.09-.745.082-.73.082-.73 1.205.085 1.84 1.237 1.84 1.237 1.07 1.835 2.807 1.305 3.492.998.108-.774.418-1.306.762-1.605-2.665-.304-5.467-1.332-5.467-5.931 0-1.31.467-2.381 1.235-3.22-.124-.303-.535-1.527.118-3.176 0 0 1.008-.322 3.3 1.23a11.51 11.51 0 013.003-.403 11.49 11.49 0 013.003.403c2.29-1.552 3.297-1.23 3.297-1.23.655 1.65.244 2.873.12 3.176.77.839 1.232 1.91 1.232 3.22 0 4.61-2.807 5.625-5.48 5.921.43.372.815 1.103.815 2.222 0 1.606-.015 2.898-.015 3.293 0 .324.216.7.825.582C20.565 21.796 24 17.297 24 12c0-6.63-5.373-12-12-12z"/>
            </svg>
          </a>

          <!-- Twitter -->
          <a href="https://twitter.com" target="_blank" class="p-2 rounded border-2 border-transparent text-[#0F4F8F] hover:border-[#C96BFF] transition-all duration-300 hover:shadow-[0_0_15px_rgba(201,107,255,0.45)]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8">
              <path d="M24 4.557a9.835 9.835 0 01-2.828.775 4.932 4.932 0 002.165-2.724 9.864 9.864 0 01-3.127 1.195 4.918 4.918 0 00-8.384 4.482A13.95 13.95 0 011.671 3.149a4.916 4.916 0 001.523 6.574 4.903 4.903 0 01-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.936 4.936 0 01-2.224.084 4.923 4.923 0 004.6 3.417A9.867 9.867 0 010 19.54a13.94 13.94 0 007.548 2.212c9.057 0 14.01-7.506 14.01-14.01 0-.213-.005-.425-.014-.636A10.025 10.025 0 0024 4.557z"/>
            </svg>
          </a>
        </div>
        <p class="mt-1 text-sm text-[#E0E6F0]">Retrouvez-moi en ligne</p>
      </div>

      <!-- Colonne 2 : Contact (image) -->
      <div class="flex-1 flex flex-col items-center justify-start gap-2 text-center border-b md:border-b-0 md:border-r border-[#0F4F8F] pb-4 md:pb-0 md:pr-4">
        <p class="font-semibold text-[#52c5ff]">Contact :</p>
        <a href="/contact" class="mt-2 p-2 rounded border-2 border-transparent hover:border-[#C96BFF] transition-all duration-300 hover:shadow-[0_0_15px_rgba(201,107,255,0.45)] bg-[#0F0F2F]/80">
          <img src="/images/icons/contact.png" alt="Contact" class="w-24 h-24"/>
        </a>
        <p class="mt-1 text-sm text-[#E0E6F0]">Pour toute demande, contactez-moi</p>
      </div>

      <!-- Colonne 3 : Backoffice / Info (image) -->
      <div class="flex flex-col items-center justify-start flex-1 gap-2 text-center">
        <p class="font-semibold text-[#52c5ff]">Backoffice :</p>
        <a href="/login" class="mt-2 p-2 rounded border-2 border-transparent hover:border-[#C96BFF] transition-all duration-300 hover:shadow-[0_0_15px_rgba(201,107,255,0.45)] bg-[#0F0F2F]/80">
          <img src="/images/icons/lock.png" alt="Se connecter" class="w-24 h-24"/>
        </a>
        <p class="mt-1 text-sm text-[#E0E6F0]">Portfolio personnel © 2025</p>
      </div>

    </div>
  </footer>
</template>

<script setup>
// Aucun script nécessaire
</script>

<style scoped>
/* Tout est appliqué via Tailwind */
</style>
