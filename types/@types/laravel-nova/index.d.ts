declare module 'laravel-nova' {
  import type { Errors as FormErrors } from 'laravel-nova-devtool'

  export namespace PreventsFormAbandonment {}
  export namespace PreventsModalAbandonment {}
  export namespace DependentFormField {}
  export namespace HandlesFormRequest {}
  export namespace HandlesUploads {}
  export namespace Localization {}
  export namespace MetricBehavior {}
  export namespace FieldValue {}
  export namespace FormEvents {}
  export namespace FormField {}
  export namespace HandlesFieldAttachments {}
  export namespace HandlesValidationErrors {}
  export namespace HasCards {}
  export namespace HandlesPanelVisibility {}
  export namespace CopiesToClipboard {}
  export class Errors extends FormErrors {}

  export function mapProps(attributes: Array<string>): {[key: string]: any};
  export function useLocalization(): {__: (key: string, replace: {[key: string]:string}) => string};
  export function usesCopyValueToClipboard(): {copyValueToClipboard: (value: string) => void};
}