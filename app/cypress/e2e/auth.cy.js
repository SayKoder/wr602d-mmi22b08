describe('Connexion valide', () => {
    it('Se connecte avec des identifiants valides', () => {
        cy.visit('/login'); 

        // Remplir les champs
        cy.get('input[name="email"]').type('carl.heintz02@gmail.com'); 
        cy.get('input[name="password"]').type('password{enter}'); 

        cy.url().should('include', '/'); // Vérifie si l'utilisateur est bien redirigé après connexion
        cy.contains('Kevinitator').should('be.visible'); 
    });
});

describe('Connexion invalide', () => {
    it('Refuse les mauvais identifiants', () => {
        cy.visit('/login');
        cy.get('input[name="email"]').type('user@example.com');
        cy.get('input[name="password"]').type('wrongpassword{enter}');
        cy.contains('Invalid credentials').should('be.visible'); // Vérifie si un message d'erreur s'affiche
    });
});

describe('Création de compte valide', () => {
    it('Crée un compte avec des informations valides', () => {
        cy.visit('/register');

        cy.get('input[name="registrationForm[firstname]"]').type('Cypress');
        cy.get('input[name="registrationForm[lastname]"]').type('Test');
        cy.get('input[name="registrationForm[email]"]').type('test@example.com');
        cy.get('input[name="registrationForm[plainPassword][first]"]').type('StrongPassword123!');
        cy.get('input[name="registrationForm[plainPassword][second]"]').type('StrongPassword123!');
        cy.get('input[name="registrationForm[subscription]"]').first().check(); 
        cy.get('input[name="registrationForm[agreeTerms]"]').check();
        cy.get('button[type="submit"]').click();

        cy.url().should('not.include', '/register'); // Vérifie que l'inscription a fonctionné
    });
});

describe('Création de compte non-valide', () => {
    it('Empêche la création de compte avec des champs vides', () => {
        cy.visit('/register');

        cy.get('input[name="registrationForm[firstname]"]').clear();
        cy.get('input[name="registrationForm[lastname]"]').clear();
        cy.get('input[name="registrationForm[email]"]').type('test@example.com');
        cy.get('input[name="registrationForm[plainPassword][first]"]').type('StrongPassword123!');
        cy.get('input[name="registrationForm[plainPassword][second]"]').type('Stro78!');
        cy.get('input[name="registrationForm[subscription]"]').first().check(); 
        cy.get('input[name="registrationForm[agreeTerms]"]').check();
        cy.get('button[type="submit"]').click();

        cy.contains('Entrez votre prénom').should('be.visible'); // Vérifie que l'erreur est affichée
        cy.contains('Entrez votre nom de famille').should('be.visible');
    });

    it('Empêche la création de compte avec des mots de passe non correspondants', () => {
        cy.visit('/register');

        cy.get('input[name="registrationForm[firstname]"]').type('Cypress');
        cy.get('input[name="registrationForm[lastname]"]').type('Test');
        cy.get('input[name="registrationForm[email]"]').type('test@example.com');
        cy.get('input[name="registrationForm[plainPassword][first]"]').type('StrongPassword123!');
        cy.get('input[name="registrationForm[plainPassword][second]"]').type('DifferentPassword456!');
        cy.get('input[name="registrationForm[subscription]"]').first().check();
        cy.get('input[name="registrationForm[agreeTerms]"]').check();
        cy.get('button[type="submit"]').click();

        cy.contains('Les mots de passe doivent correspondre').should('be.visible'); // Vérifie l'erreur
    });

    it('Empêche la création de compte sans accepter les conditions', () => {
        cy.visit('/register');

        cy.get('input[name="registrationForm[firstname]"]').type('Cypress');
        cy.get('input[name="registrationForm[lastname]"]').type('Test');
        cy.get('input[name="registrationForm[email]"]').type('test@example.com');
        cy.get('input[name="registrationForm[plainPassword][first]"]').type('StrongPassword123!');
        cy.get('input[name="registrationForm[plainPassword][second]"]').type('StrongPassword123!');
        cy.get('input[name="registrationForm[subscription]"]').first().check();
        cy.get('button[type="submit"]').click();

        cy.contains('Veuillez acceptez nos termes').should('be.visible'); // Vérifie l'erreur
    });
});
