# melvinloos/dev-vm
This repository should be an easy way to implement vagrant-ansible dev environment.
Simply add this to your dev dependencies in composer.json like so,
```
composer require melvinloos/dev-vm --dev
```
Then after updating your dependencies a composer-event script will check if the `dev-environment.yml` and `Vagrantfile` are present in your project root directory. If not it will put these in the root of the directory by copying these from the `src/MelvinLoos/DevVm/Resources` directory from this repository.

#### **DO NOT EDIT THE `Vagrantfile`!**
All necessary editing only has to be done in the `dev-environment.yml` file.
Here you can enable/disable the required software and configure their settings.
The following software is currently available through ansible roles:
 - git
 - apache
 - mongodb
 - mysql
 - nodejs
 - php
 - pimpmylog

## Required
  - vagrant
  - ansible (can also be installed & run from inside the VM)
  - nfs (or else change the sync method)

## Recommended
  - vagrant plugin: hostsupdater (`vagrant plugin install vagrant-hostsupdater`)
  - vagrant plugin: auto_network (`vagrant plugin install vagrant-auto_network`)
