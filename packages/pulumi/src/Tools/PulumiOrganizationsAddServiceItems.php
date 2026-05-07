<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * AddServiceItems.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}/items.
 */
class PulumiOrganizationsAddServiceItems extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_add_service_items';
    protected const DESCRIPTION = 'AddServiceItems

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}/items

Adds items (such as access tokens, team memberships, or stack permissions) to an existing service account. Service accounts provide programmatic, non-human access to Pulumi Cloud resources and are scoped to an organization. Items define what the service account can access and what credentials it holds. Returns the updated service details.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}/items';
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
