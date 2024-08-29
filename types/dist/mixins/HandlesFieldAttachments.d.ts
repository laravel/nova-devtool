declare namespace _default {
    let emits: string[];
    let props: {
        [key: string]: any;
    };
    function created(): Promise<void>;
    function data(): {
        draftId: any;
        files: any[];
        filesToRemove: any[];
    };
    namespace methods {
        /**
         * Upload an attachment.
         *
         * @param {any} file
         * @param {{onUploadProgress?: Function, onCompleted?: Function, onFailure?: Function}}
         */
        function uploadAttachment(file: any, { onUploadProgress, onCompleted, onFailure }: {
            onUploadProgress?: Function;
            onCompleted?: Function;
            onFailure?: Function;
        }): void;
        /**
         * Remove an attachment from the server.
         *
         * @param {string} url
         */
        function flagFileForRemoval(url: string): void;
        /**
         * Unflag an attachment from removal.
         *
         * @param {string} url
         */
        function unflagFileForRemoval(url: string): void;
        /**
         * Purge pending attachments for the draft
         */
        function clearAttachments(): void;
        function clearFilesMarkedForRemoval(): void;
        /**
         * Fill draft id for the field.
         *
         * @param {FormData} formData
         */
        function fillAttachmentDraftId(formData: FormData): void;
    }
}
export default _default;
//# sourceMappingURL=HandlesFieldAttachments.d.ts.map