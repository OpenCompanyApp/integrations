<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Migrate machine types for user-owned apps. */
class BitriseMigrateUserAppMachineTypes extends AbstractBitriseTool { protected const NAME = 'bitrise_migrate_user_app_machine_types'; protected const DESCRIPTION = 'Migrate all apps owned by a user from one machine type to another.'; protected const METHOD = 'migrateUserAppMachineTypes'; protected const ARGUMENTS = ['user_slug']; protected const REQUIRED = ['user_slug', 'payload']; protected const USE_PAYLOAD = true; }
