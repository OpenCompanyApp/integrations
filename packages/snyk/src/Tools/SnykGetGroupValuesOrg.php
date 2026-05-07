<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get group value aggregation - Org scope (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/inventory/assets/groups/{group_field_id}/values.
 */
class SnykGetGroupValuesOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_group_values_org';
    protected const DESCRIPTION = 'Get group value aggregation - Org scope (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/inventory/assets/groups/{group_field_id}/values

Returns aggregated values for a specific group field id, showing the count of assets for each distinct value. Use the UUID from the group fields list endpoint to identify which field to query. #### Required permissions - `View Organization (org.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The unique identifier of the organization',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested API version',
  ),
  'group_field_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_field_id` from the official Snyk API operation. The UUID of the group field to get values for (from the group fields list endpoint)',
  ),
  'asset_types' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `asset_types` from the official Snyk API operation. Comma-separated list of asset types to filter the aggregation',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `filter` from the official Snyk API operation. RSQL filter expression for filtering which assets are included in aggregation. Supports the same syntax as the main search filter includi...',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort` from the official Snyk API operation. Comma-separated sort fields for group values. Prefix with `-` for descending order. Multiple sort fields are supported (e.g., `-issues,co...',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Maximum number of group values to return',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Cursor for forward pagination',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Cursor for backward pagination',
  ),
  'meta_fields' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `meta_fields` from the official Snyk API operation. Meta fields to include in the response. Multiple fields can be specified. Available fields: - `count` - Number of assets with this value ...',
  ),
  'aggregate' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `aggregate` from the official Snyk API operation. Per-field aggregate function override for meta fields. All fields default to `last` when not specified. `max`/`min` compute the SQL MAX/M...',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/inventory/assets/groups/{group_field_id}/values';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'group_field_id' => 'group_field_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'asset_types' => 'asset_types',
  'filter' => 'filter',
  'sort' => 'sort',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'meta_fields' => 'meta_fields',
  'aggregate' => 'aggregate',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
