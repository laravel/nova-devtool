declare namespace _default {
    namespace props {
        namespace formUniqueId {
            let type: StringConstructor;
        }
    }
    namespace methods {
        /**
         * @param {string} attribute
         * @param {any} value
         */
        function emitFieldValue(attribute: string, value: any): void;
        /**
         * @param {string} attribute
         * @param {any} value
         */
        function emitFieldValueChange(attribute: string, value: any): void;
        /**
         * Get field attribute value event name.
         *
         * @param {string} attribute
         * @returns {string}
         */
        function getFieldAttributeValueEventName(attribute: string): string;
        /**
         * Get field attribue value event name.
         *
         * @param {string} attribute
         * @returns {string}
         */
        function getFieldAttributeChangeEventName(attribute: string): string;
    }
    namespace computed {
        /**
         * Return the field attribute.
         *
         * @returns {string}
         */
        function fieldAttribute(): string;
        /**
         * Determine if the field has Form Unique ID.
         *
         * @returns {boolean}
         */
        function hasFormUniqueId(): boolean;
        /**
         * Get field attribue value event name.
         *
         * @returns {string}
         */
        function fieldAttributeValueEventName(): string;
        /**
         * Get field attribue value event name.
         *
         * @returns {string}
         */
        function fieldAttributeChangeEventName(): string;
    }
}
export default _default;
//# sourceMappingURL=FormEvents.d.ts.map