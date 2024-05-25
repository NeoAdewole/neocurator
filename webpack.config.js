import defaultConfig from '@wordpress/scripts/config/webpack.config.js';

export default {
  ...defaultConfig,
  entry: {
    ...defaultConfig.entry(),
    "plugin/project-meta-panel": "./src/project-meta-panel"
  }
};