declare namespace _default {
    namespace props {
        namespace loadCards {
            export let type: BooleanConstructor;
            let _default: boolean;
            export { _default as default };
        }
    }
    function data(): {
        cards: any[];
    };
    /**
     * Fetch all of the metrics panels for this view
     */
    function created(): void;
    namespace watch {
        function cardsEndpoint(): void;
    }
    namespace methods {
        function fetchCards(): Promise<void>;
    }
    namespace computed {
        /**
         * Determine whether we have cards to show on the Dashboard.
         *
         * @returns {boolean}
         */
        function shouldShowCards(): boolean;
        /**
         * Determine if the cards array contains some detail-only cards.
         *
         * @returns {boolean}
         */
        function hasDetailOnlyCards(): boolean;
        /**
         * Get the extra card params to pass to the endpoint.
         *
         * @returns {null}
         */
        function extraCardParams(): null;
    }
}
export default _default;
