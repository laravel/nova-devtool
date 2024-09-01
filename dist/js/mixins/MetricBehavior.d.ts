declare namespace _default {
    namespace props {
        namespace card {
            let type: ObjectConstructor;
            let required: boolean;
        }
        namespace dashboard {
            let type_1: StringConstructor;
            export { type_1 as type };
            let required_1: boolean;
            export { required_1 as required };
        }
        namespace resourceName {
            let type_2: StringConstructor;
            export { type_2 as type };
            let _default: string;
            export { _default as default };
        }
        namespace resourceId {
            let type_3: (StringConstructor | NumberConstructor)[];
            export { type_3 as type };
            let _default_1: string;
            export { _default_1 as default };
        }
        namespace lens {
            let type_4: StringConstructor;
            export { type_4 as type };
            let _default_2: string;
            export { _default_2 as default };
        }
    }
    function created(): void;
    function beforeUnmount(): void;
    namespace methods {
        function fetch(): void;
        /**
         * @returns [Function]
         */
        function handleFetchCallback(): () => void;
    }
    namespace computed {
        /**
         * @returns {string}
         */
        function metricEndpoint(): string;
        /**
         * @returns {{[key: string]: any}}
         */
        function metricPayload(): {
            [key: string]: any;
        };
    }
}
export default _default;
//# sourceMappingURL=MetricBehavior.d.ts.map