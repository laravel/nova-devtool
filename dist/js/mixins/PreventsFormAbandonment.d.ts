declare namespace _default {
    function created(): void;
    function mounted(): void;
    function beforeUnmount(): void;
    function unmounted(): void;
    function data(): {
        removeOnNavigationChangesEvent: any;
        removeOnBeforeUnloadEvent: any;
        navigateBackUsingHistory: boolean;
    };
    namespace methods {
        /**
         * Prevent accidental abandonment only if form was changed.
         */
        function updateFormStatus(): void;
        function enableNavigateBackUsingHistory(): void;
        function disableNavigateBackUsingHistory(): void;
        /**
         * @param {Function} proceed
         * @param {Function} revert
         */
        function handlePreventFormAbandonment(proceed: Function, revert: Function): void;
        /**
         * @param {Event} event
         */
        function handlePreventFormAbandonmentOnInertia(event: Event): void;
        function handlePreventFormAbandonmentOnPopState(event: any): void;
        /**
         * @param {boolean} [reset=false]
         */
        function handleProceedingToPreviousPage(reset?: boolean): void;
        function handleProceedingToNextPage(): void;
        /**
         * @param {string} url
         */
        function proceedToPreviousPage(url: string): void;
        let allowLeavingForm: import("vuex").MutationMethod;
        let preventLeavingForm: import("vuex").MutationMethod;
        let triggerPushState: import("vuex").MutationMethod;
        let resetPushState: import("vuex").MutationMethod;
    }
    namespace computed {
        let canLeaveForm: import("vuex").Computed;
        let canLeaveFormToPreviousPage: import("vuex").Computed;
    }
}
export default _default;
//# sourceMappingURL=PreventsFormAbandonment.d.ts.map