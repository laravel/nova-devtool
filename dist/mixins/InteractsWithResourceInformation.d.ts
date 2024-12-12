declare namespace _default {
    namespace computed {
        /**
         * Get the resource information object for the current resource.
         *
         * @returns {object|null}
         */
        function resourceInformation(): object | null;
        /**
         * Get the resource information object for the current resource.
         *
         * @returns {object|null}
         */
        function viaResourceInformation(): object | null;
        /**
         * Determine if the user is authorized to create the current resource.
         *
         * @returns {boolean}
         */
        function authorizedToCreate(): boolean;
    }
}
export default _default;
