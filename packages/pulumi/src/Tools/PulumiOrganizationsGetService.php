<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetService.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}.
 */
class PulumiOrganizationsGetService extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_service';
    protected const DESCRIPTION = 'GetService

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}

Returns the details of a specific service account, including its name, owner, description, team memberships, access tokens, and stack permissions. Service accounts provide programmatic, non-human access to Pulumi Cloud resources and are identified by their owner type, owner name, and service name.';
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
);
    protected const METHOD = 'get';
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
