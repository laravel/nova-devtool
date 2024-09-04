export function useLocalization(): {
    /**
     * @param {string} key
     * @param {{[key: string]: string}} replace
     * @returns {string}
     */
    __: (key: string, replace: {
        [key: string]: string;
    }) => string;
};
