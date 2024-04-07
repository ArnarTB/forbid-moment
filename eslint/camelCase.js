// @ts-check
/** @type {import('eslint').Rule.RuleModule} */

module.exports = {
  create: function (context) {
    return {
      FunctionDeclaration: function (node) {
        const name = node.id.name;
        if (name && /^[a-z]+([A-Z][a-z0-9]+)*$/.test(name) === false) {
          context.report({
            node,
            message: 'Function name must be in camelCase.',
            data: { name },
          });
        }
      },
    };
  },
};