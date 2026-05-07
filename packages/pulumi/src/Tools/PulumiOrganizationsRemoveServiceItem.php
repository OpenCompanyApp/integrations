<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RemoveServiceItem.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}/items/{itemType}/{itemName}.
 */
class PulumiOrganizationsRemoveServiceItem extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_remove_service_item';
    protected const DESCRIPTION = 'RemoveServiceItem

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}/items/{itemType}/{itemName}

Removes a specific item (such as a team membership, access token, or stack permission) from a service account. Returns the updated service details after the item has been removed.';
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
  'item_type' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `itemType` from the official Pulumi Cloud API operation. The item type',
  ),
  'item_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `itemName` from the official Pulumi Cloud API operation. The item name',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/orgs/{orgName}/services/{ownerType}/{ownerName}/{serviceName}/items/{itemType}/{itemName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'ownerType' => 'owner_type',
  'ownerName' => 'owner_name',
  'serviceName' => 'service_name',
  'itemType' => 'item_type',
  'itemName' => 'item_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
