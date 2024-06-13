module.exports = {
  presets: [
    '@babel/preset-env',
    '@babel/preset-react' // if you're using React
  ],
  plugins: [
    '@babel/plugin-proposal-nullish-coalescing-operator',
    '@babel/plugin-proposal-optional-chaining'
  ]
};
