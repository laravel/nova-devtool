declare module 'laravel-nova-util' {
  export type filled = (values: any) => boolean;
  export type hourCycle = (locale: string) => number;
  export type increaseOrDecrease = (currentValue: number, startingValue: number) => boolean | null;
  export type minimum = (originalPromise: Promise<any>, delay?: number) => Promise<any>;
  export type singularOrPlural = (value: number, suffix: any) => string;
}