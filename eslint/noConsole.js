// @ts-check
/** @type {import('eslint').Rule.RuleModule} */

module.exports = {

    create(context) {
      return {
        CallExpression(node) {
          if (node.callee.type === "MemberExpression") {
            if (
              node.callee.property.type === "Identifier" &&
              node.callee.object.type === "Identifier" &&
              node.callee.object.name === "console" &&
              node.callee.property.name === "log"
            ) {
              context.report({
                node,
                message: "Using console is not allowed.",
              });
            }
          }
        },
      };
    },
  };