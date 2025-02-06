declare namespace _default {
    namespace computed {
        /**
         * Get the user's local timezone.
         *
         * @returns {string}
         */
        function userTimezone(): string;
        /**
         * Determine if the user is used to 12 hour time.
         *
         * @returns {boolean}
         */
        function usesTwelveHourTime(): boolean;
    }
}
export default _default;
