declare namespace _default {
    namespace props {
        namespace formUniqueId {
            let type: StringConstructor;
        }
    }
    function data(): {
        validationErrors: Errors;
    };
    namespace methods {
        /**
         * Handle all response error.
         *
         * @param {AxiosResponse} error
         */
        function handleResponseError(error: AxiosResponse): void;
        /**
         * Handle creating response error.
         *
         * @param {AxiosResponse} error
         */
        function handleOnCreateResponseError(error: AxiosResponse): void;
        /**
         * Handle updating response error.
         *
         * @param {AxiosResponse} error
         */
        function handleOnUpdateResponseError(error: AxiosResponse): void;
        /**
         * Reset validation errors.
         */
        function resetErrors(): void;
    }
}
export default _default;
export type AxiosResponse = import("axios").AxiosResponse;
import { Errors } from '../util/FormValidation';
//# sourceMappingURL=HandlesFormRequest.d.ts.map