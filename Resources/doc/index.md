Getting Started with AppleApnPushBundle
=======================================

## Prerequisites

This version of bundre requires Symfony 2.1+ and PHP >= 5.3.3

## Installation

### Step1: Dowload AppleApnPushBundle using composer

```js
{
    "required": {
        "apple/apn-push-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

```bash
$ php composer.phar update apple/apn-push-bundle
```

Composer will install the bundle to your project's `vendor/apple` directory.

### Step 2: Enable bundle

Enable bundle in the kernel:

```php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Apple\ApnPushBundle\AppleApnPushBundle(),
    );
}
```

### Step 3: Configure apn push notification managers

Minimal example:

```yml
apple_apn_push:
    managers:
        default:
            certificate: "/path/to/your/certificate.pem"
```

### Step 4: Add routing for test sending apn push (OPTIONAL!)

```yml
# app/config/routing_dev.yml
_apple_apn_push:
    resource: "@AppleApnPushBundle/Resources/config/routing.xml"
    prefix: /_apple/apn_push
```

Testing page: `http://yout-domain.com/_apple/apn_push/send`

## Usage apn push manager

All managers saved in `apple.apn_push` service.

Example get default manager:

```php
$apnPush = $container->get('apple.apn_push');
$defaultManager = $apnPush->getManager('default');
// Or
$defaultManager = $apnPush->getManager(); // Get a default notification manager

// Get notification service
$notification = $defaultManager->getNotification();
// Get feedback service
$notification = $defaultManager->getFeedback();

// Alias for send message
$defaultManager->sendMessage($message);
// Message must be instance \Apple\ApnPush\Notification\MessageInterface interface
```

### Next Steps

Now that you have completed the basic installation and configuration of the AppleApnPushBundle.

The following documents are available:

- [Manager configuration](manager_config.md)
- [Use many managers](many_managers.md)
- [Default parameters](default_parameters.md)
- [Command Line Tools](command_line.md)