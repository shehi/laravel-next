import { defineConfig } from 'cypress';

export default defineConfig({
    viewportWidth: 1280,
    viewportHeight: 960,

    e2e: {
        baseUrl: 'http://localhost:3000',
        specPattern: 'cypress/e2e/**/*.{ts,tsx}',
    },

    component: {
        viewportWidth: 800,
        viewportHeight: 400,
        devServer: {
            framework: 'next',
            bundler: 'webpack',
        },
    },
});
