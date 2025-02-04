export function useResourceInformation(): {
    resourceInformation: (resourceName: any) => any;
    viaResourceInformation: (viaRelation: any) => any;
    authorizedToCreate: (resourceName: any, relationshipType?: any) => any;
};
