type Badge = {
  typeClass: string;
  value: any;
}

export type Menu = {
  key: string;
  name: string;
  component: "menu-section" | "menu-group" | "menu-item";
  items: (Menu | MenuItem)[];
  collapsable: boolean;
  icon: string;
  path: string;
  active?: boolean;
  badge?: Badge;
}

export type MenuItem = {
  active: boolean;
  prefixComponent: boolean;
  onlyOnDetail: boolean;
  badge?: Badge;
  component: 'menu-item';
  data?: Object;
  external: boolean;
  headers?: {
    [key: string]: string;
  };
  method: 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE';
  name: string;
  path: string;
  target?: '_self' | '_blank' | '_parent' | '_top';
}