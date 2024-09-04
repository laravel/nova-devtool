declare namespace _default {
    let namespaced: boolean;
    function state(): {
        filters: any[];
        originalFilters: any[];
    };
    namespace getters {
        function filters(state: any): any;
        function originalFilters(state: any): any;
        function hasFilters(state: any): boolean;
        function currentFilters(state: any, getters: any): any;
        function currentEncodedFilters(state: any, getters: any): string;
        function filtersAreApplied(state: any, getters: any): boolean;
        function activeFilterCount(state: any, getters: any): any;
        function getFilter(state: any): (filterKey: any) => any;
        function getOriginalFilter(state: any): (filterKey: any) => any;
        function getOptionsForFilter(state: any, getters: any): (filterKey: any) => any;
        function filterOptionValue(state: any, getters: any): (filterKey: any, optionKey: any) => any;
    }
    namespace actions {
        /**
         * Fetch the current filters for the given resource name.
         */
        function fetchFilters({ commit, state }: {
            commit: any;
            state: any;
        }, options: any): Promise<void>;
        /**
         * Reset the default filter state to the original filter settings.
         */
        function resetFilterState({ commit, getters }: {
            commit: any;
            getters: any;
        }): Promise<void>;
        /**
         * Initialize the current filter values from the decoded query string.
         */
        function initializeCurrentFilterValuesFromQueryString({ commit, getters }: {
            commit: any;
            getters: any;
        }, encodedFilters: any): Promise<void>;
    }
    namespace mutations {
        function updateFilterState(state: any, { filterClass, value }: {
            filterClass: any;
            value: any;
        }): void;
        /**
         * Store the mutable filter settings
         */
        function storeFilters(state: any, data: any): void;
        /**
         * Clear the filters for this resource
         */
        function clearFilters(state: any): void;
    }
}
export default _default;
