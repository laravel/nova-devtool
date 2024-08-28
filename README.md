![Nova Devtool](https://banners.beyondco.de/Nova%20Devtool.png?theme=light&packageManager=composer+require&packageName=laravel%2Fnova-devtool&pattern=cage&style=style_1&description=Devtool+for+Laravel+Nova+Components+Development&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg)

## Installation

You can install the Nova tool via Composer:

```shell
composer require --dev laravel/nova-devtool
```

## Usages

### Setup Laravel Nova Workbench

Laravel Nova Devtool can setup a basic Laravel Nova installation using `workbench` directory via [Orchestra Workbench](https://github.com/orchestral/workbench). To start the installation you can run the following command:

```shell
php vendor/bin/testbench workbench:install --devtool
```

Once the installation is completed, you should be able to serve Laravel Nova by running the following command:

```shell
composer run serve
```

#### Automatically logged-in the default user

Instead of manually logging-in the user, you may also change `testbench.yaml` to automatically authenticate the user:

```diff
workbench:
  start: /nova
+ user: nova@laravel.com
  build:
```

### Install Axios, Lodash, Tailwind CSS or Vue

To simplify the installation, you can run the following commnad:

```shell
php vendor/bin/testbench nova:devtool install
```

### Enables Vue DevTool for Laravel Nova

By default, Laravel Nova ship with JavaScript compiled for production without Vue DevTool. In order to enable Vue DevTool, you need to run the following command:

```shell
php vendor/bin/testbench nova:devtool enable-vue-devtool
```

### Disables Vue DevTool for Laravel Nova

To reverse the above action, you need to run the following command:

```shell
php vendor/bin/testbench nova:devtool disable-vue-devtool
```