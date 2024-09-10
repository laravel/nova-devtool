declare const _default: import("vue").DefineComponent<import("vue").ExtractPropTypes<{
    as: {
        default: string;
    };
    size: {
        default: string;
    };
    label: {};
    variant: {
        default: string;
    };
    state: {
        default: string;
    };
    padding: {
        default: string;
    };
    loading: {
        type: BooleanConstructor;
        default: boolean;
    };
    disabled: {
        type: BooleanConstructor;
        default: boolean;
    };
    icon: {};
    leadingIcon: {};
    trailingIcon: {};
}>, (_ctx: any, _cache: any) => import("vue").VNode<import("vue").RendererNode, import("vue").RendererElement, {
    [key: string]: any;
}>, {}, {}, {}, import("vue").ComponentOptionsMixin, import("vue").ComponentOptionsMixin, {}, string, import("vue").PublicProps, Readonly<{
    variant: string;
    size: string;
    disabled: boolean;
    as: string;
    state: string;
    padding: string;
    loading: boolean;
} & {
    icon?: unknown;
    label?: unknown;
    leadingIcon?: unknown;
    trailingIcon?: unknown;
} & {}>, {
    variant: string;
    size: string;
    disabled: boolean;
    as: string;
    state: string;
    padding: string;
    loading: boolean;
}, {}, {}, {}, string, import("vue").ComponentProvideOptions, true, {}>;
export default _default;