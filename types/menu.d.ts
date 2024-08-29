export type Menu = {
  key: string;
  name: string;
  component: "menu-section" | "menu-group" | "menu-item";
  items: (Menu | MenuItem)[];
  collapsable: boolean;
  icon: string;
  path: string;
  active?: boolean;
  badge?: import('./components.d').Badge;
};