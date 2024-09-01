declare namespace _default {
    export { FormField as extends };
    export let emits: string[];
    export namespace props {
        namespace syncEndpoint {
            let type: StringConstructor;
            let required: boolean;
        }
    }
    export function data(): {
        dependentFieldDebouncer: any;
        canceller: any;
        watchedFields: {};
        watchedEvents: {};
        syncedField: any;
        pivot: boolean;
        editMode: string;
    };
    export function created(): void;
    export function mounted(): void;
    export function beforeUnmount(): void;
    export namespace methods {
        function setInitialValue(): void;
        /**
         * Provide a function to fills FormData when field is visible.
         *
         * @param {FormData} formData
         * @param {string} attribute
         * @param {any} value
         */
        function fillIfVisible(formData: FormData, attribute: string, value: any): void;
        function syncField(): void;
        function onSyncedField(): void;
        function emitOnSyncedFieldValueChange(): void;
        /**
         * @returns {boolean}
         */
        function syncedFieldValueHasNotChanged(): boolean;
    }
    export namespace computed {
        /**
         * Determine the current field
         *
         * @returns {object}
         */
        function currentField(): object;
        /**
         * Determine if the field is in visible mode.
         *
         * @returns {boolean}
         */
        function currentlyIsVisible(): boolean;
        /**
         * Determine if the field is in readonly mode.
         *
         * @returns {boolean}
         */
        function currentlyIsReadonly(): boolean;
        /**
         * @returns {string[]}
         */
        function dependsOn(): string[];
        /**
         * @returns {{[key: string]: any}}
         */
        function currentFieldValues(): {
            [key: string]: any;
        };
        /**
         * @returns {{[key: string]: any}}
         */
        function dependentFieldValues(): {
            [key: string]: any;
        };
        /**
         * @returns {string}
         */
        function encodedDependentFieldValues(): string;
        /**
         * Get the correct field sync endpoint URL.
         *
         * @returns {string}
         */
        function syncFieldEndpoint(): string;
    }
}
export default _default;
import FormField from './FormField';
//# sourceMappingURL=DependentFormField.d.ts.map