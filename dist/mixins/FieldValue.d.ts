declare namespace _default {
    let props: string[];
    namespace methods {
        /**
         * @param {any} value
         * @returns {boolean}
         */
        function isEqualsToValue(value: any): boolean;
    }
    namespace computed {
        /**
         * @returns {string}
         */
        function fieldAttribute(): string;
        /**
         * @returns {boolean}
         */
        function fieldHasValue(): boolean;
        /**
         * @returns {boolean}
         */
        function usesCustomizedDisplay(): boolean;
        /**
         * @returns {boolean}
         */
        function fieldHasValueOrCustomizedDisplay(): boolean;
        /**
         * @returns {string|null}
         */
        function fieldValue(): string | null;
        /**
         * @returns {string|null}
         */
        function shouldDisplayAsHtml(): string | null;
    }
}
export default _default;
