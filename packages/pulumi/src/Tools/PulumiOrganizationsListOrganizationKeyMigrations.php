<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListOrganizationKeyMigrations.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/cmk/migration.
 */
class PulumiOrganizationsListOrganizationKeyMigrations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_organization_key_migrations';
    protected const DESCRIPTION = 'ListOrganizationKeyMigrations

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/cmk/migration

Returns all key encryption key (KEK) migrations for an organization. KEK migrations track the process of re-encrypting secrets when rotating customer managed keys. Each migration record includes the source and destination keys, status, and any errors encountered during the migration process.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/cmk/migration';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
