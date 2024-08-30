import type { AppConfig, default as Nova } from "../dist/nova";
import type { Form, Errors } from "../dist/util/FormValidation";

export {
  AppConfig,
  Nova,
  Form,
  Errors
}

declare global {
  interface Window {
    createNovaApp: (config: AppConfig) => Nova;
    Nova: Nova;
  }
}
