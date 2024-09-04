declare namespace _default {
    function data(): {
        isWorking: boolean;
        fileUploadsCount: number;
    };
    namespace methods {
        /**
         * Handle file upload finishing
         */
        function handleFileUploadFinished(): void;
        /**
         * Handle file upload starting
         */
        function handleFileUploadStarted(): void;
    }
}
export default _default;
