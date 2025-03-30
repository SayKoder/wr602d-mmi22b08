const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    setupNodeEvents(on, config) {
      // implement event listeners here
    },
    specPattern: "cypress/e2e/**/*.cy.js",
  },
});
