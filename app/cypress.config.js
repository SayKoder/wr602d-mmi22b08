const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    baseUrl: "http://localhost", // Mets l'URL de ton projet Symfony si différente
    specPattern: "cypress/e2e/**/*.cy.js",
    supportFile: false, // Désactive le fichier support s'il n'existe pas
  },
});
