describe('SPA', () => {
    it('renders', () => {
        cy.visit('/');
        cy.url().should('eq', 'http://localhost:3000/');

        cy.intercept('GET', '/api/cards?sort=0', { fixture: 'api/cards-unsorted.json' });

        cy.get('main > aside')
            .should('exist')
            .should('be.visible')
            .should('contain', 'Loading...');

        cy.get('main > aside').should('not.exist');

        cy.get('main > form').should('exist').should('be.visible');
        cy.get('main > form > h2').should('exist').should('be.visible').should('contain', 'Controls');
        cy.get('main > form > fieldset > button').should('exist').should('be.visible').should('have.length', 3);
        cy.get('main > form > fieldset > button:nth-child(1)').should('be.enabled').should('contain', 'Sort ASC');
        cy.get('main > form > fieldset > button:nth-child(2)').should('be.enabled').should('contain', 'Sort DESC');
        cy.get('main > form > fieldset > button:nth-child(3)').should('be.disabled').should('contain', 'SUBMIT');

        cy.get('main > section').should('exist').should('be.visible');
        cy.get('main > section > h2').should('exist').should('be.visible').should('contain', 'Overview');
        cy.get('main > section > ul > li').should('exist').should('be.visible').should('have.length', 6);

        cy.get('main > section > ul > li:nth-child(1) > .grid > :nth-child(2)').should('contain', 'Brianna Forbes');
        cy.get('main > section > ul > li:nth-child(6) > .grid > :nth-child(2)').should('contain', 'Hillary Gibbs');
        cy.get('main > section > ul > li > .grid > .truncate').should('exist').should('have.length', 18);
    });

    it('sorts DESC', () => {
        cy.visit('/');
        cy.url().should('eq', 'http://localhost:3000/');

        cy.intercept('GET', '/api/cards?sort=0', { fixture: 'api/cards-unsorted.json' });
        cy.intercept('GET', '/api/cards?sort=-1', { fixture: 'api/cards-sorted-desc.json' });

        cy.get('main > section').should('exist').should('be.visible');
        cy.get('main > section > h2').should('exist').should('be.visible').should('contain', 'Overview');
        cy.get('main > section > ul > li').should('exist').should('be.visible').should('have.length', 6);
        cy.get('main > section > ul > li:nth-child(1) > .grid > :nth-child(2)').should('contain', 'Brianna Forbes');
        cy.get('main > section > ul > li:nth-child(6) > .grid > :nth-child(2)').should('contain', 'Hillary Gibbs');

        cy.get('main > form').should('exist').should('be.visible');
        cy.get('main > form > h2').should('exist').should('be.visible').should('contain', 'Controls');
        cy.get('main > form > fieldset > button').should('exist').should('be.visible').should('have.length', 3);
        cy.get('main > form > fieldset > button:nth-child(2)').should('be.enabled').should('contain', 'Sort DESC').click();
        cy.get('main > form > fieldset > button:nth-child(2)').should('contain', 'Sort DESC').should('be.disabled');

        cy.get('main > section > ul > li:nth-child(1) > .grid > :nth-child(2)').should('contain', 'Hillary Gibbs');
        cy.get('main > section > ul > li:nth-child(6) > .grid > :nth-child(2)').should('contain', 'Brianna Forbes');
    });

    it('selects a card and submits', () => {
        cy.visit('/');
        cy.url().should('eq', 'http://localhost:3000/');

        cy.intercept('GET', '/api/cards?sort=0', { fixture: 'api/cards-unsorted.json' });
        cy.intercept('POST', '/api/cards', { fixture: 'api/card.json' });

        cy.get('main > article').should('not.exist');

        cy.get('main > section').should('exist').should('be.visible');
        cy.get('main > section > h2').should('exist').should('be.visible').should('contain', 'Overview');
        cy.get('main > section > ul > li').should('exist').should('be.visible').should('have.length', 6);
        cy.get('main > section > ul > li > .bg-red-100').should('not.exist');
        cy.get('main > section > ul > li:nth-child(1) > .grid > :nth-child(2)').should('contain', 'Brianna Forbes');

        cy.get('main > form > fieldset > button:nth-child(3)').should('be.disabled').should('contain', 'SUBMIT');

        cy.get('main > section > ul > li:nth-child(1)').click();
        cy.get('main > section > ul > li > .bg-red-100').should('exist').should('have.length', 1);
        cy.get('main > section > ul > li:nth-child(1) > dl').should('have.class', 'bg-red-100');

        cy.get('main > article').should('exist');
        cy.get('main > article > h2').should('exist').should('be.visible').should('contain', 'Detail');
        cy.get('main > article > dl > :nth-child(2)').should('contain', 'Brianna Forbes');

        cy.get('main > form > fieldset > button:nth-child(3)').should('be.enabled').should('contain', 'SUBMIT');
        cy.get('main > form > fieldset > button:nth-child(3)').click();
    });
});
