<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List API keys.
 *
 * Maps to the official Rootly endpoint get /v1/api_keys.
 */
class RootlyListApiKeys extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_api_keys';
    protected const DESCRIPTION = 'List API keys

Official Rootly endpoint: GET /v1/api_keys

List API keys for the current organization. Returns key metadata including name, kind, expiration, and last usage — the secret token value is never included in the response.

**API key kinds:**
- `personal` — tied to a specific user, inherits that user\'s permissions.
- `team` — scoped to one or more teams (groups), creates a service account with permissions derived from group membership.
- `organization` — organization-wide, creates a service account with a configurable role and on-call role.

**Automated rotation workflow:** Use `filter[expires_at][lt]` to find keys approaching expiration, then call the rotate endpoint to issue a new token before the old one expires. Combine with `filter[active]=true` to exclude already-expired keys.

**Sorting:** Use the `sort` parameter with a field name (e.g., `sort=expires_at`). Prefix with `-` for descending order (e.g., `sort=-created_at`). Allowed fields: `name`, `kind`, `created_at`, `updated_at`, `expires_at`, `last_used_at`.';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of relationships to include (role, on_call_role, created_by, groups)',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
  'filter_kind' =>
  array (
    'type' => 'string',
    'description' => 'Filter by API key kind: personal, team, organization',
  ),
  'filter_search' =>
  array (
    'type' => 'string',
    'description' => 'Search by name (case-insensitive partial match)',
  ),
  'filter_name' =>
  array (
    'type' => 'string',
    'description' => 'Filter by exact name',
  ),
  'filter_user_id' =>
  array (
    'type' => 'string',
    'description' => 'Filter by the user ID that owns the key',
  ),
  'filter_group_ids' =>
  array (
    'type' => 'string',
    'description' => 'Filter team keys by group IDs (comma-separated)',
  ),
  'filter_role_id' =>
  array (
    'type' => 'string',
    'description' => 'Filter by role ID',
  ),
  'filter_active' =>
  array (
    'type' => 'boolean',
    'description' => 'When true, return only non-expired keys',
  ),
  'filter_expired' =>
  array (
    'type' => 'boolean',
    'description' => 'When true, return only expired keys',
  ),
  'filter_created_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'Created after (ISO 8601)',
  ),
  'filter_created_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'Created at or after (ISO 8601)',
  ),
  'filter_created_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'Created before (ISO 8601)',
  ),
  'filter_created_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'Created at or before (ISO 8601)',
  ),
  'filter_expires_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'Expires after (ISO 8601)',
  ),
  'filter_expires_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'Expires at or after (ISO 8601)',
  ),
  'filter_expires_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'Expires before (ISO 8601). Useful for finding keys approaching expiration.',
  ),
  'filter_expires_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'Expires at or before (ISO 8601)',
  ),
  'filter_last_used_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'Last used after (ISO 8601)',
  ),
  'filter_last_used_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'Last used at or after (ISO 8601)',
  ),
  'filter_last_used_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'Last used before (ISO 8601)',
  ),
  'filter_last_used_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'Last used at or before (ISO 8601)',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'Sort by field. Prefix with - for descending (e.g., -created_at, expires_at)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/api_keys';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[kind]' => 'filter_kind',
  'filter[search]' => 'filter_search',
  'filter[name]' => 'filter_name',
  'filter[user_id]' => 'filter_user_id',
  'filter[group_ids]' => 'filter_group_ids',
  'filter[role_id]' => 'filter_role_id',
  'filter[active]' => 'filter_active',
  'filter[expired]' => 'filter_expired',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'filter[expires_at][gt]' => 'filter_expires_at_gt',
  'filter[expires_at][gte]' => 'filter_expires_at_gte',
  'filter[expires_at][lt]' => 'filter_expires_at_lt',
  'filter[expires_at][lte]' => 'filter_expires_at_lte',
  'filter[last_used_at][gt]' => 'filter_last_used_at_gt',
  'filter[last_used_at][gte]' => 'filter_last_used_at_gte',
  'filter[last_used_at][lt]' => 'filter_last_used_at_lt',
  'filter[last_used_at][lte]' => 'filter_last_used_at_lte',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
