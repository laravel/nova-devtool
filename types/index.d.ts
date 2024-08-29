import type { 
  App as VueApp,
  Component as VueComponent 
} from 'vue'
type Menu = import('./menu').Menu

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
  app: VueApp;
  appConfig: AppConfig;
  mountTo: Element;
  store: import('vuex').Store<any>;
  boot: () => void;
  booting: (callback: BootingCallback) => void;
  config: (key: string|null) => any;
  countdown(): Promise<void>;
  inertia: (name: string, component: VueComponent | string) => void;
  liftOff: () => void;
  request: (options: Object) => import('axios').AxiosInstance;
}

declare global {
  interface Window {
    Nova: NovaApp;
  }
}