import type { Menu } from './menu'

type BootingCallback = ((app: any, store: any) => void);

type Color = {
  [key: string]: string;
}

export type AppConfig = {
  algoliaApiKey?: any;
  algoliaAppId?: any;
  appName: string;
  base: string;
  brandColors: Color[];
  brandColorsCSS: string;
  customLoginPath: boolean;
  customLogoutPath: boolean;
  debounce: number;
  footer: string;
  forgotPasswordPath: string | boolean;
  globalSearchEnabled: boolean;
  hasGloballySearchableResources: boolean;
  initialPath: string;
  locale: string;
  logo?: string;
  mainMenu: Menu[];
  notificationCenterEnabled: boolean;
  notificationPollingInterval: number;
  pagination: string;
  resetPasswordPath: boolean;
  resources: Resource[];
  rtlEnabled: boolean;
  themeSwitcherEnabled: boolean;
  timezone: string;
  translations: Translations;
  userId: number;
  userMenu: Menu[];
  userTimezone?: any;
  version: string;
  withAuthentication: boolean;
  withPasswordReset: boolean;
}

type Resource = {
  uriKey: string;
  label: string;
  singularLabel: string;
  createButtonLabel: string;
  updateButtonLabel: string;
  authorizedToCreate: boolean;
  searchable: boolean;
  perPageOptions: number[];
  tableStyle: string;
  showColumnBorders: boolean;
  debounce: number;
  clickAction: string;
};

type Translations = {
  [key: string]: string;
}

export declare type NovaApp = {
  $router: import('@inertiajs/core').Router;
  app: import('vue').App<Element>;
  appConfig: AppConfig;
  mountTo: Element;
  store: import('vuex').Store<any>;
  boot: () => void;
  booting: (callback: BootingCallback) => void;
  config: (key: string|null) => any;
  countdown(): Promise<void>;
  request: (options: Object) => import('axios').AxiosInstance;
  liftOff(): void;
}

declare global {
  interface Window {
    Nova: NovaApp    
  }
}