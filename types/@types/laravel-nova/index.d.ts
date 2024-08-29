declare module 'laravel-nova' {
  export type AxiosResponse = import("axios").AxiosResponse;
  import type { Errors as FormErrors } from 'laravel-nova-devtool'

  export class Errors extends FormErrors {}

  export namespace PreventsFormAbandonment {
    function data(): {
      removeOnNavigationChangesEvent: any;
      removeOnBeforeUnloadEvent: any;
      navigateBackUsingHistory: boolean;
    };
    namespace methods {
      function updateFormStatus(): void;
      function enableNavigateBackUsingHistory(): void;
      function disableNavigateBackUsingHistory(): void;
      function handlePreventFormAbandonment(proceed: Function, revert: Function): void;
      function handlePreventFormAbandonmentOnInertia(event: Event): void;
      function handlePreventFormAbandonmentOnPopState(event: any): void;
      function handleProceedingToPreviousPage(reset?: boolean): void;
      function handleProceedingToNextPage(): void;
      function proceedToPreviousPage(url: string): void;
      let allowLeavingForm: import("vuex").MutationMethod;
      let preventLeavingForm: import("vuex").MutationMethod;
      let triggerPushState: import("vuex").MutationMethod;
      let resetPushState: import("vuex").MutationMethod;
    }
    namespace computed {
      let canLeaveForm: import("vuex").Computed;
      let canLeaveFormToPreviousPage: import("vuex").Computed;
    }
  }
  export namespace PreventsModalAbandonment {
    namespace methods {
      function updateModalStatus(): void;
      function handlePreventModalAbandonment(proceed: Function, revert: Function): void;
      let allowLeavingModal: import("vuex").MutationMethod;
      let preventLeavingModal: import("vuex").MutationMethod;
    }
    namespace computed {
      let canLeaveModal: import("vuex").Computed;
    }
  }
  export namespace DependentFormField {
    export function data(): {
      dependentFieldDebouncer: any;
      canceller: any;
      watchedFields: {};
      watchedEvents: {};
      syncedField: any;
      pivot: boolean;
      editMode: string;
    };
    export namespace methods {
      function setInitialValue(): void;
      function fillIfVisible(formData: FormData, attribute: string, value: any): void;
      function syncField(): void;
      function onSyncedField(): void;
      function emitOnSyncedFieldValueChange(): void;
      function syncedFieldValueHasNotChanged(): boolean;
    }
    export namespace computed {
      function currentField(): object;
      function currentlyIsVisible(): boolean;
      function currentlyIsReadonly(): boolean;
      function dependsOn(): string[];
      function currentFieldValues(): {
          [key: string]: any;
      };
      function dependentFieldValues(): {
          [key: string]: any;
      };
      function encodedDependentFieldValues(): string;
      function syncFieldEndpoint(): string;
    }
  }
  export namespace HandlesFormRequest {
    function data(): {
      validationErrors: Errors;
    };
    namespace methods {
      function handleResponseError(error: AxiosResponse): void;
      function handleOnCreateResponseError(error: AxiosResponse): void;
      function handleOnUpdateResponseError(error: AxiosResponse): void;
      function resetErrors(): void;
    }
  }
  export namespace HandlesUploads {
    function data(): {
      isWorking: boolean;
      fileUploadsCount: number;
    };
    namespace methods {
      function handleFileUploadFinished(): void;
      function handleFileUploadStarted(): void;
    }
  }
  export namespace Localization {
    namespace methods {
      function __(key: string, replace: {
        [key: string]: string;
      }): string;
    }
  }
  export namespace MetricBehavior {
    namespace methods {
      function fetch(): void;
      function handleFetchCallback(): () => void;
    }
    namespace computed {
      function metricEndpoint(): string;
      function metricPayload(): {
          [key: string]: any;
      };
    }
  }
  export namespace FieldValue {
    namespace methods {
      function isEqualsToValue(value: any): boolean;
    }
    namespace computed {
      function fieldAttribute(): string;
      function fieldHasValue(): boolean;
      function usesCustomizedDisplay(): boolean;
      function fieldValue(): string | null;
      function shouldDisplayAsHtml(): string | null;
    }
  }
  export namespace FormEvents {
    namespace methods {
      function emitFieldValue(attribute: string, value: any): void;
      function emitFieldValueChange(attribute: string, value: any): void;
      function getFieldAttributeValueEventName(attribute: string): string;
      function getFieldAttributeChangeEventName(attribute: string): string;
    }
    namespace computed {
        function fieldAttribute(): string;
        function hasFormUniqueId(): boolean;
        function fieldAttributeValueEventName(): string;
        function fieldAttributeChangeEventName(): string;
    }
  }
  export namespace FormField {
    export { FormEvents as extends };
    export function data(): {
      value: any;
    };
    export namespace methods {
      function setInitialValue(): void;
      function fieldDefaultValue(): string;
      function fill(formData: FormData): void;
      function fillIfVisible(formData: FormData, attribute: string, value: any): void;
      function handleChange(event: Event): void;
      function beforeRemove(): void;
      function listenToValueChanges(value: any): void;
    }
    export namespace computed {
      function currentField(): object;
      function fullWidthContent(): boolean;
      function placeholder(): string;
      function isVisible(): boolean;
      function isReadonly(): boolean;
      function isActionRequest(): boolean;
    }
  }
  export namespace HandlesFieldAttachments {
    function data(): {
      draftId: string;
      files: any[];
      filesToRemove: any[];
  };
  namespace methods {
      function uploadAttachment(file: any, { onUploadProgress, onCompleted, onFailure }: {
          onUploadProgress?: Function;
          onCompleted?: Function;
          onFailure?: Function;
      }): void;
      function flagFileForRemoval(url: string): void;
      function unflagFileForRemoval(url: string): void;
      function clearAttachments(): void;
      function clearFilesMarkedForRemoval(): void;
      function fillAttachmentDraftId(formData: FormData): void;
    }
  }
  export namespace HandlesValidationErrors {
    namespace computed {
      function errorClasses(): string[];
      function fieldAttribute(): string;
      function validationKey(): string;
      function hasError(): boolean;
      function firstError(): string;
      function nestedAttribute(): string | null;
      function nestedValidationKey(): string | null;
    }
  }
  export namespace HasCards {
    namespace methods {
      function fetchCards(): Promise<void>;
    }
    namespace computed {
      function shouldShowCards(): boolean;
      function hasDetailOnlyCards(): boolean;
      function extraCardParams(): null;
    }
  }
  export namespace HandlesPanelVisibility {
    function data(): {
      visibleFieldsForPanel: {[key: string]: boolean};
    };
    namespace methods {
      function handleFieldShown(field: string): void;
      function handleFieldHidden(field: string): void;
    }
    namespace computed {
      function visibleFieldsCount(): number;
    }
  }
  export namespace CopiesToClipboard {
    namespace methods {
      function copyValueToClipboard(value: string): void;
    }
  }

  export function mapProps(attributes: Array<string>): {[key: string]: any};
  export function useLocalization(): {__: (key: string, replace: {[key: string]:string}) => string};
  export function usesCopyValueToClipboard(): {copyValueToClipboard: (value: string) => void};
}
