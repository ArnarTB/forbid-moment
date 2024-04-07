import noConsole from "./noConsole";
import { RuleTester } from "@typescript-eslint/rule-tester";

const ruleTester = new RuleTester({
  parser: require.resolve("@typescript-eslint/parser"),
});

const errors = [{ message: "Using console is not allowed." }];
ruleTester.run("noConsole", noConsole, {
  valid: [{ code: `console.clear();` }],
  invalid: [{ code: `console.log("Hello World!");`, errors }],
});