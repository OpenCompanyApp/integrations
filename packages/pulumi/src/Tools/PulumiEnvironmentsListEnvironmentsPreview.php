<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListEnvironments.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments.
 */
class PulumiEnvironmentsListEnvironmentsPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_environments_preview';
    protected const DESCRIPTION = 'ListEnvironments

Official Pulumi Cloud endpoint: GET /api/preview/environments

Returns a paginated list of all Pulumi ESC environments accessible to the authenticated user across all organizations they belong to. Each entry includes the organization, project, environment name, and creation/modification timestamps. Use the organization query parameter to filter results to a specific organization. Use continuationToken for pagination through large result sets.';
    protected const PARAMETERS = array (
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for paginated results',
  ),
  'include_referrer_metadata' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `includeReferrerMetadata` from the official Pulumi Cloud API operation. Whether to include referrer metadata. Defaults to false.',
  ),
  'max_results' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `maxResults` from the official Pulumi Cloud API operation. Maximum number of results for pagination',
  ),
  'organization' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization` from the official Pulumi Cloud API operation. Filter results to this organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/environments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'includeReferrerMetadata' => 'include_referrer_metadata',
  'maxResults' => 'max_results',
  'organization' => 'organization',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
