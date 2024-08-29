import type { 
  App as VueApp,
  Component as VueComponent 
} from 'vue'
import type { Router } from '@inertiajs/core'
import type { AxiosInstance } from 'axios'
import type { Store } from 'vuex'
import type { Form } from './form'
import type { Menu } from './menu'

type State = {
  baseUri: string;
  currentUser: any;
  mainMenu: any[];
  userMenu: any[];
  resources: any[];
  version: string;
  mainMenuShown: boolean;
  canLeaveForm: boolean;
  canLeaveModal: boolean;
  pushStateWasTriggered: boolean;
  validLicense: true;
  [key: string]: any;
}

type BootingCallback = ((app: VueApp, store: Store<State>) => void);

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
  [key: string]: any;
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
  pages: {[key: string]: VueComponent | string};
  $router: Router;
  readonly appConfig: AppConfig;
  store: Store<State>;
  
  boot: () => void;
  booting: (callback: BootingCallback) => void;
  booted: (callback: BootingCallback) => void;
  config: (key: string) => any;
  countdown(): Promise<void>;
  form: (data: {[key: string]: any}) => Form;
  hasSecurityFeatures(): boolean;
  liftOff: () => void;
  missingResource: (uriKey: string) => boolean;
  redirectToLogin: () => void;
  url: (path: string, parameters: any) => string;

  request: (options: Object) => AxiosInstance;

  inertia: (name: string, component: VueComponent | string) => void;
  visit: (path: ({ url: string; remote: boolean; } | string), options?: Object) => void;

  component: (name: string, component: VueComponent | string) => void;
  hasComponent: (name: string) => boolean;

  debug: (message: any, type?: string) => void;
  log: (message: string, type?: string) => void;

  error: (message: string) => void;
  info: (message: string) => void;
  success: (message: string) => void;
  warning: (message: string) => void;

  formatNumber: (number: number, format: any | string) => string;

  $emit: (event: string, ...args: any[]) => void;
  $on: (event: string, callback: Function, ctx?: any) => void;
  $once: (event: string, callback: Function, ctx?: any) => void;
  $off: (event: string, callback?: Function) => void;
}

declare global {
  interface Window {
    Nova: NovaApp;
  }
}