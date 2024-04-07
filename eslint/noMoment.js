// @ts-nocheck
/** @type {import('eslint').Rule.RuleModule} */
module.exports = {
    create(context) {
      return {
        ImportDeclaration(node) {
          if (node.source.value === 'moment') {
            context.report({
              node,
              message: 'Moment is deprecated, use others.',
            });
          }
        },
      };
    },
  };