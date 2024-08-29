import type { AppConfig, default as Nova } from "./dist/nova";
import type { filled, hourCycle, increaseOrDecrease, minimum, singularOrPlural } from "./dist/util/index";
import type { Form, Errors } from "./dist/util/FormValidation";

export {
  AppConfig,
  Nova,
  Form,
  Errors
}

declare module 'laravel-nova-util' {
  export function filled(value: any): boolean;
  export function hourCycle(locale: string): number;
  export function increaseOrDecrease(currentValue: number, startingValue: number): boolean | null;
  export function minimum(originalPromise: Promise<any>, delay?: number): Promise<any>;
  export function singularOrPlural(value: number, suffix: any): string;
}

declare global {
  interface Window {
    createNovaApp: (config: AppConfig) => Nova;
    Nova: Nova;
    LaravelNovaUtil: {
      filled, hourCycle, increaseOrDecrease, minimum, singularOrPlural
    };
  }
}