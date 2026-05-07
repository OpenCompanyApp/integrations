<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get issues by group ID.
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/issues.
 */
class SnykListGroupIssues extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_group_issues';
    protected const DESCRIPTION = 'Get issues by group ID

Official Snyk endpoint: GET /groups/{group_id}/issues

Get a list of a group\'s issues. #### Required permissions - `View Issues (group.issues.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
  'scan_item_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `scan_item.id` from the official Snyk API operation. A scan item id to filter issues through their scan item relationship.',
  ),
  'scan_item_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `scan_item.type` from the official Snyk API operation. A scan item types to filter issues through their scan item relationship.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `type` from the official Snyk API operation. An issue type to filter issues.',
  ),
  'updated_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updated_before` from the official Snyk API operation. A filter to select issues updated before this date.',
  ),
  'updated_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `updated_after` from the official Snyk API operation. A filter to select issues updated after this date.',
  ),
  'created_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_before` from the official Snyk API operation. A filter to select issues created before this date.',
  ),
  'created_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_after` from the official Snyk API operation. A filter to select issues created after this date.',
  ),
  'effective_severity_level' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `effective_severity_level` from the official Snyk API operation. One or more effective severity levels to filter issues.',
  ),
  'status' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `status` from the official Snyk API operation. An issue\'s status',
  ),
  'ignored' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `ignored` from the official Snyk API operation. Whether an issue is ignored or not.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/issues';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'scan_item.id' => 'scan_item_id',
  'scan_item.type' => 'scan_item_type',
  'type' => 'type',
  'updated_before' => 'updated_before',
  'updated_after' => 'updated_after',
  'created_before' => 'created_before',
  'created_after' => 'created_after',
  'effective_severity_level' => 'effective_severity_level',
  'status' => 'status',
  'ignored' => 'ignored',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
