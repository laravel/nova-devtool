declare module 'laravel-nova-util' {
  export function filled(value: any): boolean;
  export function hourCycle(locale: string): number;
  export function increaseOrDecrease(currentValue: number, startingValue: number): boolean | null;
  export function minimum(originalPromise: Promise<any>, delay?: number): Promise<any>;
  export function singularOrPlural(value: number, suffix: any): string;
}
