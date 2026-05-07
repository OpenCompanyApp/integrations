<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListDeletedEnvironments.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/restore.
 */
class PulumiEnvironmentsListDeletedEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_deleted_environments';
    protected const DESCRIPTION = 'ListDeletedEnvironments

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/restore

Returns a paginated list of soft-deleted Pulumi ESC environments within an organization that are still within the retention window and eligible for restoration. Use the continuationToken query parameter for pagination. Deleted environments can be restored via the RestoreEnvironment endpoint.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/environments/{orgName}/restore';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
