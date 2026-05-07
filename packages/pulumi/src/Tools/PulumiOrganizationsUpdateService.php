<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateService.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}.
 */
class PulumiOrganizationsUpdateService extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_service';
    protected const DESCRIPTION = 'UpdateService

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}

Updates the metadata and configuration of an existing service account, such as its description, team memberships, and access settings. Service accounts provide programmatic, non-human access to Pulumi Cloud resources.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'owner_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `ownerType` from the official Pulumi Cloud API operation. The owner type',
  ),
  'owner_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `ownerName` from the official Pulumi Cloud API operation. The owner name',
  ),
  'service_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `serviceName` from the official Pulumi Cloud API operation. The service name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'ownerType' => 'owner_type',
  'ownerName' => 'owner_name',
  'serviceName' => 'service_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
