/**
 * @typedef {import('axios').AxiosInstance} AxiosInstance
 * @typedef {import('axios').AxiosResponse} AxiosResponse
 * @typedef {{[key: string]: any}} FormPayloads
 * @typedef {{http?: AxiosInstance, resetOnSuccess?: boolean, onSuccess?: Function, onFail?: Function}} FormOptions
 */
export class Form {
    static create(data?: {}): Form;
    /**
     * Create a new Form instance.
     *
     * @param {FormPayloads} data
     * @param {FormOptions} options
     */
    constructor(data?: FormPayloads, options?: FormOptions);
    processing: boolean;
    successful: boolean;
    /**
     * @param {FormPayloads} data
     */
    withData(data: FormPayloads): this;
    errors: Errors;
    /**
     * @param {ErrorCollection} errors
     */
    withErrors(errors: ErrorCollection): this;
    /**
     * @param {FormOptions} options
     */
    withOptions(options: FormOptions): this;
    /** @private */
    private __options;
    /**
     * Handle a successful form submission.
     *
     * @param {any} data
     */
    onSuccess(data: any): void;
    /**
     * Handle a failed form submission.
     *
     * @param {AxiosResponse} error
     */
    onFail(error: AxiosResponse): void;
    /**
     * @protected
     * @type {AxiosInstance}
     */
    protected __http: AxiosInstance;
    /**
     * Fetch all relevant data for the form.
     *
     * @returns {FormPayloads}
     */
    data(): FormPayloads;
    /**
     * Fetch specific data for the form.
     *
     * @param {string[]} fields
     * @returns {FormPayloads}
     */
    only(fields: string[]): FormPayloads;
    /**
     * Reset the form fields.
     */
    reset(): void;
    /**
     * @param {FormPayloads} values
     */
    setInitialValues(values: FormPayloads): void;
    /** @private */
    private initial;
    /**
     * @param {FormPayloads} data
     */
    populate(data: FormPayloads): this;
    /**
     * Clear the form fields.
     */
    clear(): void;
    /**
     * Send a POST request to the given URL.
     *
     * @param {string} url
     */
    post(url: string): Promise<any>;
    /**
     * Send a PUT request to the given URL.
     *
     * @param {string} url
     */
    put(url: string): Promise<any>;
    /**
     * Send a PATCH request to the given URL.
     *
     * @param {string} url
     */
    patch(url: string): Promise<any>;
    /**
     * Send a DELETE request to the given URL.
     *
     * @param {string} url
     */
    delete(url: string): Promise<any>;
    /**
     * Submit the form.
     *
     * @param {string} requestType
     * @param {string} url
     */
    submit(requestType: string, url: string): Promise<any>;
    /**
     * @returns {boolean}
     */
    hasFiles(): boolean;
    /**
     * @param {Object|Array} object
     * @returns {boolean}
     */
    hasFilesDeep(object: any | any[]): boolean;
    /**
     * Get the error message(s) for the given field.
     *
     * @param {string} field
     * @returns {boolean}
     */
    hasError(field: string): boolean;
    /**
     * Get the first error message for the given field.
     *
     * @param {string} field
     * @returns {string|null}
     */
    getError(field: string): string | null;
    /**
     * Get the error messages for the given field.
     *
     * @param {string} field
     * @returns {string[]}
     */
    getErrors(field: string): string[];
    /**
     * @param {string} requestType
     */
    __validateRequestType(requestType: string): void;
}
/**
 * @typedef {{[key: string]: string[]}} ErrorCollection
 */
export class Errors {
    /**
     * Create a new Errors instance.
     *
     * @param {ErrorCollection} [errors={}]
     */
    constructor(errors?: ErrorCollection);
    /**
     * Get all the errors.
     *
     * @returns {ErrorCollection}
     */
    all(): ErrorCollection;
    /**
     * Determine if any errors exists for the given field or object.
     *
     * @param {string} field
     * @returns {boolean}
     */
    has(field: string): boolean;
    /**
     * Get the first error for the given field or object.
     *
     * @param {string} field
     * @returns {string|null}
     */
    first(field: string): string | null;
    /**
     * Get the errors for the given field or object.
     *
     * @param {string} field
     * @returns {string[]}
     */
    get(field: string): string[];
    /**
     * Determine if we have any errors.
     * Or return errors for the given keys.
     *
     * @param {string[]} [keys=[]]
     * @returns {ErrorCollection}
     */
    any(keys?: string[]): ErrorCollection;
    /**
     * Record the new errors.
     *
     * @param {ErrorCollection} [errors={}]
     */
    record(errors?: ErrorCollection): void;
    /** @type {ErrorCollection} */
    errors: ErrorCollection;
    /**
     * Clear a specific field, object or all error fields.
     *
     * @param {string|null} field
     */
    clear(field: string | null): void;
}
export type AxiosInstance = import("axios").AxiosInstance;
export type AxiosResponse = import("axios").AxiosResponse;
export type FormPayloads = {
    [key: string]: any;
};
export type FormOptions = {
    http?: AxiosInstance;
    resetOnSuccess?: boolean;
    onSuccess?: Function;
    onFail?: Function;
};
export type ErrorCollection = {
    [key: string]: string[];
};
//# sourceMappingURL=FormValidation.d.ts.map