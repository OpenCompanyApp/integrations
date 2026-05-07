<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Start an export.
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/export.
 */
class SnykCreateGroupExport extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_group_export';
    protected const DESCRIPTION = 'Start an export

Official Snyk endpoint: POST /groups/{group_id}/export

Create and start an export for a group #### Required permissions - `View reports (group.report.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
  'include_deleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `include_deleted` from the official Snyk API operation. Optional parameter to include deleted issues in results',
  ),
  'include_deactivated' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `include_deactivated` from the official Snyk API operation. Optional parameter to include disabled issues in results',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/groups/{group_id}/export';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'include_deleted' => 'include_deleted',
  'include_deactivated' => 'include_deactivated',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
