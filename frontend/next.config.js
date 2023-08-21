/**
 * @see https://nextjs.org/docs/api-reference/next.config.js/introduction
 */
const path = require('path');

// Make sure adding Sentry options is the last code to run before exporting, to
// ensure that your source maps include changes from all other Webpack plugins
module.exports = {
    // eslint: {
    //     ignoreDuringBuilds: true,
    // },
    output: 'standalone',
    poweredByHeader: false,
    reactStrictMode: true,
    sassOptions: {
        includePaths: [path.join(__dirname, 'styles')]
    },
    swcMinify: true,
};
