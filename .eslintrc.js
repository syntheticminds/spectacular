module.exports = {
    'env': {
        'browser': true,
        'es2021': true,
        'node': true
    },
    'extends': [
        'eslint:recommended',
        'plugin:vue/vue3-essential'
    ],
    'parserOptions': {
        'ecmaVersion': 13,
        'sourceType': 'module'
    },
    'plugins': [
        'vue'
    ],
    'rules': {
        'indent': ['error', 4, {'SwitchCase': 1}],
        'semi': ['error', 'always']
    }
};
