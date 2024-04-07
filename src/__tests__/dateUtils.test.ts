import { describe, it, expect } from "vitest";
import { add, isWithinRange, isDateBefore, isSameDay } from "../dateUtils"; // Adjust the path as necessary
import { DATE_UNIT_TYPES } from "../constants"; // Assuming this is necessary for your tests

describe("Tests Adding dates", () => {
  it("Adds days together for the right date", () => {
    const startDate = new Date(2024, 6, 25);
    const daysToAdd = 10;
    const result = add(startDate, daysToAdd, DATE_UNIT_TYPES.DAYS);
    const expected = new Date(2024, 7, 4);
    expect(result).toEqual(expected);
  });
  it("Adds days together for the wrong date", () => {
    const startDate = new Date(2024, 6, 25);
    const daysToAdd = 10;
    const result = add(startDate, daysToAdd, DATE_UNIT_TYPES.DAYS);
    const expected = new Date(2024, 7, 5);
    expect(result).not.toEqual(expected);
  });
  it("Adds months together for the right date", () => {
    const startDate = new Date(2024, 6, 25);
    const monthsToAdd = 2;
    const result = add(startDate, monthsToAdd, DATE_UNIT_TYPES.MONTHS);
    const expected = new Date(2024, 8, 25);
    expect(result).toEqual(expected);
  });
  it("Adds months together for the wrong date", () => {
    const startDate = new Date(2024, 6, 25);
    const monthsToAdd = 2;
    const result = add(startDate, monthsToAdd, DATE_UNIT_TYPES.MONTHS);
    const expected = new Date(2024, 8, 26);
    expect(result).not.toEqual(expected);
  });
  it("Adds years together for the right date", () => {
    const startDate = new Date(2024, 6, 25);
    const yearsToAdd = 2;
    const result = add(startDate, yearsToAdd, DATE_UNIT_TYPES.YEARS);
    const expected = new Date(2026, 6, 25);
    expect(result).toEqual(expected);
  });
  it("Adds years together for the wrong date", () => {
    const startDate = new Date(2024, 6, 25);
    const yearsToAdd = 2;
    const result = add(startDate, yearsToAdd, DATE_UNIT_TYPES.YEARS);
    const expected = new Date(2026, 6, 26);
    expect(result).not.toEqual(expected);
  });
});
describe("Tests isWithinRange", () => {
  it("tests a date that is within range", () => {
    const date = new Date(2024, 6, 25);
    const from = new Date(2024, 6, 1);
    const to = new Date(2024, 6, 30);
    const result = isWithinRange(date, from, to);
    expect(result).toBe(true);
  });

  it("tests a date that is not within range", () => {
    const date = new Date(2025, 6, 25);
    const from = new Date(2024, 6, 1);
    const to = new Date(2024, 6, 30);
    const result = isWithinRange(date, from, to);
    expect(result).toBe(false);
  });
});
describe("Tests isDateBefore", () => {
  it("tests a date that is befor an other date", () => {
    const date = new Date(2024, 6, 25);
    const compareDate = new Date(2024, 6, 26);
    const result = isDateBefore(date, compareDate);
    expect(result).toBe(true);
  });
  it("tests a date that is not before an other date", () => {
    const date = new Date(2024, 6, 25);
    const compareDate = new Date(2024, 6, 24);
    const result = isDateBefore(date, compareDate);
    expect(result).toBe(false);
  });
});
describe("Tests isSameDay", () => {
  it("tests two of the same day", () => {
    const date = new Date(2024, 6, 25);
    const compareDate = new Date(2024, 6, 25);
    const result = isSameDay(date, compareDate);
    expect(result).toBe(true);
  });
  it("tests two different days", () => {
    const date = new Date(2024, 6, 25);
    const compareDate = new Date(2024, 7, 26);
    const result = isSameDay(date, compareDate);
    expect(result).toBe(false);
  });
});
