declare namespace _default {
    function state(): {
        notifications: any[];
        notificationsShown: boolean;
        unreadNotifications: boolean;
    };
    namespace getters {
        function notifications(s: any): any;
        function notificationsShown(s: any): any;
        function unreadNotifications(s: any): any;
    }
    namespace mutations {
        function toggleNotifications(state: any): void;
    }
    namespace actions {
        function fetchNotifications({ state }: {
            state: any;
        }): Promise<void>;
        function markNotificationAsUnread({ state, dispatch }: {
            state: any;
            dispatch: any;
        }, id: any): Promise<void>;
        function markNotificationAsRead({ state, dispatch }: {
            state: any;
            dispatch: any;
        }, id: any): Promise<void>;
        function deleteNotification({ state, dispatch }: {
            state: any;
            dispatch: any;
        }, id: any): Promise<void>;
        function deleteAllNotifications({ state, dispatch }: {
            state: any;
            dispatch: any;
        }, id: any): Promise<void>;
        function markAllNotificationsAsRead({ state, dispatch }: {
            state: any;
            dispatch: any;
        }, id: any): Promise<void>;
    }
}
export default _default;
