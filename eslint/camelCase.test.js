import { RuleTester } from "@typescript-eslint/rule-tester";
import camelcase from "./camelCase"; 

const ruleTester = new RuleTester({
  parser: require.resolve('@typescript-eslint/parser'),
});


const errors = [{
  message: 'Function name must be in camelCase.'
}];


ruleTester.run("camelcase", camelcase, {
  valid: [ {code:
    "function camelCaseFunction() {}"}
  ],
  invalid: [
    {
      code: "function NotCamelCaseFunction() {}",
      errors,
    }
  ],
});
