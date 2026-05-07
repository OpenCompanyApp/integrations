<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListChangeRequests.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/change-requests/{orgName}.
 */
class PulumiOrganizationsListChangeRequests extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_change_requests';
    protected const DESCRIPTION = 'ListChangeRequests

Official Pulumi Cloud endpoint: GET /api/change-requests/{orgName}

Lists change requests for an organization with support for pagination and filtering by entity type and entity ID. Change requests represent proposed infrastructure modifications that require approval before being applied.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for paginated results',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `count` from the official Pulumi Cloud API operation. Number of items to return',
  ),
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entityId` from the official Pulumi Cloud API operation. The entity identifier to filter by',
  ),
  'entity_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entityType` from the official Pulumi Cloud API operation. The entity type to filter by',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/change-requests/{orgName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'count' => 'count',
  'entityId' => 'entity_id',
  'entityType' => 'entity_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
