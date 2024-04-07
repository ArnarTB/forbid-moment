import datefns from "date-fns";
import { DATE_UNIT_TYPES } from "./constants";

export function add(date: Date, number: number, type = DATE_UNIT_TYPES.DAYS) {
  return datefns.add(date, { [type]: number });
}

export function isWithinRange(date: Date, from: Date, to: Date) {
  return datefns.isWithinInterval(date, { start: from, end: to });
}

export function isDateBefore(date: Date, compareDate: Date) {
  return datefns.isBefore(date, compareDate);
}

export function isSameDay(date: Date, compareDate: Date) {
  return datefns.isSameDay(date, compareDate);
}
