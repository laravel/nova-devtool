class NovaExtension {
  name() {
    return 'nova-extension'
  }

  register(name) {
    this.name = name
  }

  webpackRules() {
    return {
      test: /\.(postcss)$/,
      use: [
        'vue-style-loader',
        { loader: 'css-loader', options: { importLoaders: 1 } },
        'postcss-loader',
      ],
    }
  }

  webpackConfig(webpackConfig) {
    webpackConfig.externals = {
      vue: 'Vue',
      'laravel-nova': 'LaravelNova',
      'laravel-nova-ui': 'LaravelNovaUi',
      'laravel-nova-util': 'LaravelNovaUtil',
    }

    webpackConfig.output = {
      uniqueName: this.name,
    }
  }
}

module.exports = NovaExtension
