<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RetryOrganizationKeyMigrations.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/cmk/migration/retry.
 */
class PulumiOrganizationsRetryOrganizationKeyMigrations extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_retry_organization_key_migrations';
    protected const DESCRIPTION = 'RetryOrganizationKeyMigrations

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/cmk/migration/retry

Retries any failed key encryption key (KEK) migrations for an organization. KEK migrations can fail due to transient errors when re-encrypting secrets during customer managed key rotation. This endpoint re-attempts the failed migrations without restarting the entire process.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/cmk/migration/retry';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
