declare namespace _default {
    namespace props {
        namespace errors {
            function _default(): Errors;
            export { _default as default };
        }
    }
    namespace inject {
        namespace index {
            let _default_1: any;
            export { _default_1 as default };
        }
        namespace viaParent {
            let _default_2: any;
            export { _default_2 as default };
        }
    }
    function data(): {
        errorClass: string;
    };
    namespace computed {
        /**
         * @returns {string[]}
         */
        function errorClasses(): string[];
        /**
         * @returns {string}
         */
        function fieldAttribute(): string;
        /**
         * @returns {string}
         */
        function validationKey(): string;
        /**
         * @returns {boolean}
         */
        function hasError(): boolean;
        /**
         * @returns {string}
         */
        function firstError(): string;
        /**
         * @returns {string|null}
         */
        function nestedAttribute(): string | null;
        /**
         * @returns {string|null}
         */
        function nestedValidationKey(): string | null;
    }
}
export default _default;
import { Errors } from '../util/FormValidation';
