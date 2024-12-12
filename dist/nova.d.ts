/**
 * @typedef {import('vuex').Store} VueStore
 * @typedef {import('vue').App} VueApp
 * @typedef {import('vue').Component} VueComponent
 * @typedef {import('vue').DefineComponent} DefineComponent
 * @typedef {import('axios').AxiosInstance} AxiosInstance
 * @typedef {import('axios').AxiosRequestConfig} AxiosRequestConfig
 * @typedef {Object<string, any>} AppConfig
 * @typedef {import('./util/FormValidation').Form} Form
 * @typedef {(app: VueApp, store: VueStore) => void} BootingCallback
 */
export default class Nova {
    /**
     * @param {AppConfig} config
     */
    constructor(config: AppConfig);
    /**
     * @protected
     * @type {Array<BootingCallback>}
     */
    protected bootingCallbacks: Array<BootingCallback>;
    /** @readonly */
    readonly appConfig: {
        [x: string]: any;
    };
    /**
     * @private
     * @type {boolean}
     */
    private useShortcuts;
    /**
     * @protected
     * @type {{[key: string]: VueComponent|DefineComponent}}
     */
    protected pages: {
        [key: string]: VueComponent | DefineComponent;
    };
    /** @protected */
    protected $toasted: any;
    /** @public */
    public $progress: {
        start: (force: any) => void;
        done: () => void;
    };
    /** @public */
    public $router: import("@inertiajs/core").Router;
    /** @readonly */
    readonly $testing: {
        timezone: (timezone: any) => void;
    };
    /**
     * Register a callback to be called before Nova starts. This is used to bootstrap
     * addons, tools, custom fields, or anything else Nova needs
     *
     * @param {BootingCallback} callback
     */
    booting(callback: BootingCallback): void;
    /**
     * Execute all of the booting callbacks.
     */
    boot(): void;
    /** @type {VueStore} */
    store: VueStore;
    /**
     * @param {BootingCallback} callback
     */
    booted(callback: BootingCallback): void;
    countdown(): Promise<void>;
    /** @protected */
    protected mountTo: Element;
    /**
     * @protected
     * @type VueApp
     */
    protected app: VueApp;
    /**
     * Start the Nova app by calling each of the tool's callbacks and then creating
     * the underlying Vue instance.
     */
    liftOff(): void;
    /** @private */
    private notificationPollingInterval;
    /**
     * Return configuration value from a key.
     *
     * @param  {string} key
     * @returns {any}
     */
    config(key: string): any;
    /**
     * Return a form object configured with Nova's preconfigured axios instance.
     *
     * @param {{[key: string]: any}} data
     * @returns {Form}
     */
    form(data: {
        [key: string]: any;
    }): Form;
    /**
     * Return an axios instance configured to make requests to Nova's API
     * and handle certain response codes.
     *
     * @param {AxiosRequestConfig|null} [options=null]
     * @returns {AxiosInstance}
     */
    request(options?: AxiosRequestConfig | null): AxiosInstance;
    /**
     * Get the URL from base Nova prefix.
     *
     * @param {string} path
     * @param {any} parameters
     * @returns {string}
     */
    url(path: string, parameters: any): string;
    /**
     * @returns {boolean}
     */
    hasSecurityFeatures(): boolean;
    /**
     * Register a listener on Nova's built-in event bus
     *
     * @param {string} name
     * @param {Function} callback
     * @param {any} ctx
     */
    $on(...args: any[]): void;
    /**
     * Register a one-time listener on the event bus
     *
     * @param {string} name
     * @param {Function} callback
     * @param {any} ctx
     */
    $once(...args: any[]): void;
    /**
     * Unregister an listener on the event bus
     *
     * @param {string} name
     * @param {Function} callback
     */
    $off(...args: any[]): void;
    /**
     * Emit an event on the event bus
     *
     * @param {string} name
     */
    $emit(...args: any[]): void;
    /**
     * Determine if Nova is missing the requested resource with the given uri key
     *
     * @param {string} uriKey
     * @returns {boolean}
     */
    missingResource(uriKey: string): boolean;
    /**
     * Register a keyboard shortcut.
     *
     * @param {string} keys
     * @param {Function} callback
     */
    addShortcut(keys: string, callback: Function): void;
    /**
     * Unbind a keyboard shortcut.
     *
     * @param {string} keys
     */
    disableShortcut(keys: string): void;
    /**
     * Pause all keyboard shortcuts.
     */
    pauseShortcuts(): void;
    /**
     * Resume all keyboard shortcuts.
     */
    resumeShortcuts(): void;
    /**
     * Register the built-in Vuex modules for each resource
     */
    registerStoreModules(): void;
    /**
     * Register Inertia component.
     *
     * @param {string} name
     * @param {VueComponent|DefineComponent} component
     */
    inertia(name: string, component: VueComponent | DefineComponent): void;
    /**
     * Register a custom Vue component.
     *
     * @param {string} name
     * @param {VueComponent|DefineComponent} component
     */
    component(name: string, component: VueComponent | DefineComponent): void;
    /**
     * Check if custom Vue component exists.
     *
     * @param {string} name
     * @returns {boolean}
     */
    hasComponent(name: string): boolean;
    /**
     * Show an error message to the user.
     *
     * @param {string} message
     */
    info(message: string): void;
    /**
     * Show an error message to the user.
     *
     * @param {string} message
     */
    error(message: string): void;
    /**
     * Show a success message to the user.
     *
     * @param {string} message
     */
    success(message: string): void;
    /**
     * Show a warning message to the user.
     *
     * @param {string} message
     */
    warning(message: string): void;
    /**
     * Format a number using numbro.js for consistent number formatting.
     *
     * @param {number} number
     * @param {Object|string} format
     * @returns {string}
     */
    formatNumber(number: number, format: any | string): string;
    /**
     * Log a message to the console with the NOVA prefix
     *
     * @param {string} message
     * @param {string} [type=log]
     */
    log(message: string, type?: string): void;
    /**
     * Log a message to the console for debugging purpose
     *
     * @param {any} message
     * @param {string} [type=log]
     */
    debug(message: any, type?: string): void;
    /**
     * Redirect to login path.
     */
    redirectToLogin(): void;
    /**
     * Visit page using Inertia visit or window.location for remote.
     *
     * @param {{url: string, remote: boolean} | string} path
     * @param {any} [options={}]
     */
    visit(path: {
        url: string;
        remote: boolean;
    } | string, options?: any): void;
    applyTheme(): void;
}
export type VueStore = import("vuex").Store<any>;
export type VueApp = import("vue").App;
export type VueComponent = import("vue").Component;
export type DefineComponent = import("vue").DefineComponent;
export type AxiosInstance = import("axios").AxiosInstance;
export type AxiosRequestConfig = import("axios").AxiosRequestConfig;
export type AppConfig = {
    [x: string]: any;
};
export type Form = import("./util/FormValidation").Form;
export type BootingCallback = (app: VueApp, store: VueStore) => void;
