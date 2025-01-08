export function usePanelVisibility(panel?: {
    attribute: string;
    fields: any[];
}, emitter?: any): {
    handleFieldShown: (field: any) => void;
    handleFieldHidden: (field: any) => void;
    visibleFieldsCount: import("vue").Ref<number, number>;
};
