import type { AxiosInstance, AxiosResponse } from 'axios'

export type FormData = {
  [key: string]: any;
}

type FormOptions = {
  http?: AxiosInstance;
  resetOnSuccess?: boolean;
  onSuccess?: Function;
  onFail?: Function;
}

export declare type Form = {
  create: (data?: FormData) => Form;

  processing: boolean;
  successful: boolean;
  errors: Errors;
  __http: AxiosInstance;

  delete: (url: string) => Promise<any>;
  patch: (url: string) => Promise<any>;
  post: (url: string) => Promise<any>;
  put: (url: string) => Promise<any>;
  submit: (requestType: string, url: string) => Promise<any>;

  getError: (field: string) => string | null;
  getErrors: (field: string) => string[];

  hasError: (field: string) => boolean;
  hasFiles(): () => boolean;
  hasFilesDeep: (object: any | any[]) => boolean;

  clear: () => void;
  data: () => FormData;
  only: (fields: any[]) => FormData;
  populate: (data: FormData) => Form;
  reset: () => void;
  setInitialValues: (values: FormData) => void;

  onFail: (error: AxiosResponse) => void;
  onSuccess: (data: any) => void;

  withData: (data: FormData) => Form;
  withErrors: (errors: ErrorCollection) => Form;
  withOptions: (options: FormOptions) => Form;

  [key: string]: any;
}

export type ErrorCollection = {
  [key: string]: string[];
}

export declare type Errors = {
  errors: ErrorCollection;

  all: () => ErrorCollection;
  any: (keys?: string[]) => ErrorCollection;
  clear: (field: string | null) => void;
  first: (field: string) => string | null;
  get: (field: string) => string[];
  has: (field: string) => boolean;
  record: (errors?: ErrorCollection) => void;
}