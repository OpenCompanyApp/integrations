<?php

namespace OpenCompany\Integrations\Bitrise\Tools;

/** Migrate machine types for Workspace-owned apps. */
class BitriseMigrateOrganizationAppMachineTypes extends AbstractBitriseTool { protected const NAME = 'bitrise_migrate_organization_app_machine_types'; protected const DESCRIPTION = 'Migrate all apps owned by a Workspace from one machine type to another.'; protected const METHOD = 'migrateOrganizationAppMachineTypes'; protected const ARGUMENTS = ['organization_slug']; protected const REQUIRED = ['organization_slug', 'payload']; protected const USE_PAYLOAD = true; }
