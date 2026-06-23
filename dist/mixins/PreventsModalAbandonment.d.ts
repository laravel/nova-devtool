declare namespace _default {
    namespace methods {
        /**
         * Prevent accidental abandonment only if form was changed.
         */
        function updateModalStatus(): void;
        /**
         * @param {Function} proceed
         * @param {Function} revert
         */
        function handlePreventModalAbandonment(proceed: Function, revert: Function): void;
        let allowLeavingModal: import("vuex").MutationMethod;
        let preventLeavingModal: import("vuex").MutationMethod;
    }
    namespace computed {
        let canLeaveModal: import("vuex").Computed;
    }
}
export default _default;
