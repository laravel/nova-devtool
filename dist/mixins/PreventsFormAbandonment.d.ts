declare namespace _default {
    function data(): {
        navigateBackUsingHistory: boolean;
    };
    namespace methods {
        function enableNavigateBackUsingHistory(): void;
        function disableNavigateBackUsingHistory(): void;
        /**
         * @param {boolean} [reset=false]
         */
        function handleProceedingToPreviousPage(reset?: boolean): void;
        /**
         * @api
         * @param {string} url
         */
        function proceedToPreviousPage(url: string): void;
    }
}
export default _default;
