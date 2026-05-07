<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteService.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}.
 */
class PulumiOrganizationsDeleteService extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_service';
    protected const DESCRIPTION = 'DeleteService

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}

Deletes a service account from an organization. Service accounts provide programmatic, non-human access to Pulumi Cloud resources. If the service has other members, deletion requires explicit confirmation via the force parameter. All access tokens and permissions associated with the service are revoked.';
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
  'force' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `force` from the official Pulumi Cloud API operation. Force deletion even if the service has other members',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'ownerType' => 'owner_type',
  'ownerName' => 'owner_name',
  'serviceName' => 'service_name',
);
    protected const QUERY_PARAMS = array (
  'force' => 'force',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
