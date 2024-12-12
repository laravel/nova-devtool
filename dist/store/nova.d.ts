declare namespace _default {
    function state(): {
        baseUri: string;
        currentUser: any;
        currentUserPasswordConfirmed: any;
        mainMenu: any[];
        userMenu: any[];
        breadcrumbs: any[];
        resources: any[];
        version: string;
        mainMenuShown: boolean;
        canLeaveModal: boolean;
        validLicense: boolean;
        queryStringParams: {};
        compiledQueryStringParams: string;
    };
    namespace getters {
        function currentUser(s: any): any;
        function currentUserPasswordConfirmed(s: any): any;
        function currentVersion(s: any): any;
        function mainMenu(s: any): any;
        function userMenu(s: any): any;
        function breadcrumbs(s: any): any;
        function mainMenuShown(s: any): any;
        function canLeaveModal(s: any): any;
        function validLicense(s: any): any;
        function queryStringParams(s: any): any;
    }
    namespace mutations {
        function allowLeavingModal(state: any): void;
        function preventLeavingModal(state: any): void;
        function toggleMainMenu(state: any): void;
    }
    namespace actions {
        function login({ commit, dispatch }: {
            commit: any;
            dispatch: any;
        }, { email, password, remember }: {
            email: any;
            password: any;
            remember: any;
        }): Promise<void>;
        function logout({ state }: {
            state: any;
        }, customLogoutPath: any): Promise<any>;
        function startImpersonating({}: {}, { resource, resourceId }: {
            resource: any;
            resourceId: any;
        }): Promise<void>;
        function stopImpersonating({}: {}): Promise<void>;
        function confirmedPasswordStatus({ state, dispatch }: {
            state: any;
            dispatch: any;
        }): Promise<void>;
        function passwordConfirmed({ state, dispatch }: {
            state: any;
            dispatch: any;
        }): Promise<void>;
        function passwordUnconfirmed({ state }: {
            state: any;
        }): Promise<void>;
        function assignPropsFromInertia({ state, dispatch }: {
            state: any;
            dispatch: any;
        }): Promise<void>;
        function fetchPolicies({ state, dispatch }: {
            state: any;
            dispatch: any;
        }): Promise<void>;
        function syncQueryString({ state }: {
            state: any;
        }): Promise<void>;
        function updateQueryString({ state }: {
            state: any;
        }, value: any): Promise<any>;
    }
}
export default _default;
