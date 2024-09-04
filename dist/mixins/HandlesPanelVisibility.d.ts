declare namespace _default {
    let emits: string[];
    function data(): {
        visibleFieldsForPanel: {};
    };
    function created(): void;
    namespace methods {
        /**
         * @param {string} field
         */
        function handleFieldShown(field: string): void;
        /**
         * @param {string} field
         */
        function handleFieldHidden(field: string): void;
    }
    namespace computed {
        /**
         * @returns {number}
         */
        function visibleFieldsCount(): number;
    }
}
export default _default;
