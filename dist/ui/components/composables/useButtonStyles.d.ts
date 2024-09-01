import type { ButtonPadding, ButtonSize, ButtonSizeMap, ButtonVariant, ButtonVariantMap } from '../types';
export declare function useButtonStyles(): {
    base: string;
    baseAs: string;
    disabled: string;
    variants: ButtonVariantMap;
    availableSizes: () => ButtonSizeMap;
    checkSize: (variant: ButtonVariant, size: ButtonSize) => boolean;
    validateSize: (variant: ButtonVariant, size: ButtonSize) => void;
    validatePadding: (variant: ButtonVariant, padding: ButtonPadding) => void;
    iconType: (variant: ButtonVariant, size: ButtonSize) => string;
};
//# sourceMappingURL=useButtonStyles.d.ts.map