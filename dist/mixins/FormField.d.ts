declare namespace _default {
    export { FormEvents as extends };
    export let props: {
        [key: string]: any;
    };
    export let emits: string[];
    export function data(): {
        value: any;
    };
    export function created(): void;
    export function mounted(): void;
    export function beforeUnmount(): void;
    export namespace methods {
        function setInitialValue(): void;
        /**
         * Return the field default value.
         *
         * @returns {string}
         */
        function fieldDefaultValue(): string;
        /**
         * Provide a function that fills a passed FormData object with the
         * field's internal value attribute.
         *
         * @param {FormData} formData
         */
        function fill(formData: FormData): void;
        /**
         * Provide a function to fills FormData when field.
         *
         * @param {FormData} formData
         * @param {string} attribute
         * @param {any} value
         */
        function fillInto(formData: FormData, attribute: string, value: any): void;
        /**
         * Provide a function to fills FormData when field is visible.
         *
         * @param {FormData} formData
         * @param {string} attribute
         * @param {any} value
         */
        function fillIfVisible(formData: FormData, attribute: string, value: any): void;
        /**
         * Update the field's internal value..
         *
         * @param {Event} event
         */
        function handleChange(event: Event): void;
        /**
         * Clean up any side-effects when removing this field dynamically (Repeater).
         */
        function beforeRemove(): void;
        /**
         * @param {any} value
         */
        function listenToValueChanges(value: any): void;
    }
    export namespace computed {
        /**
         * Determine the current field.
         *
         * @returns {object}
         */
        function currentField(): object;
        /**
         * Determine if the field should use all the available white-space.
         *
         * @returns {boolean}
         */
        function fullWidthContent(): boolean;
        /**
         * Return the placeholder text for the field.
         *
         * @returns {string}
         */
        function placeholder(): string;
        /**
         * Determine if the field is in visible mode
         *
         * @returns {boolean}
         */
        function isVisible(): boolean;
        /**
         * Determine if the field is in readonly mode.
         *
         * @returns {boolean}
         */
        function isReadonly(): boolean;
        /**
         * Determine if the field is in immutable state.
         *
         * @return {boolean}
         */
        function isImmutable(): boolean;
        /**
         * Determine if the field is accessed from Action.
         *
         * @returns {boolean}
         */
        function isActionRequest(): boolean;
    }
}
export default _default;
import FormEvents from './FormEvents';
