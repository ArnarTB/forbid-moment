import noMoment from "./noMoment";
import { RuleTester } from "@typescript-eslint/rule-tester";

const ruleTester = new RuleTester({
  parser: require.resolve('@typescript-eslint/parser'),
});

const errors = [{ message: 'Moment is deprecated, use others.' }];

ruleTester.run("noMoment", noMoment, {
  valid: [
    { code: `import { getYear } from "date-fns";` }
  ],
  invalid: [
    { code: `import moment from "moment";`, errors }
  ]
});