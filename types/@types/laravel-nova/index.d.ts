declare module 'laravel-nova' {
  import type { Errors as FormErrors } from 'laravel-nova-devtool'

  export namespace PreventsFormAbandonment {}
  export namespace PreventsModalAbandonment {}
  export namespace DependentFormField {}
  export namespace HandlesFormRequest {}
  export namespace HandlesUploads {}
  export namespace Localization {}
  export namespace MetricBehavior {}
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
  export class Errors extends FormErrors {}

  export function mapProps(attributes: Array<string>): {[key: string]: any};
  export function useLocalization(): {__: (key: string, replace: {[key: string]:string}) => string};
  export function usesCopyValueToClipboard(): {copyValueToClipboard: (value: string) => void};
}