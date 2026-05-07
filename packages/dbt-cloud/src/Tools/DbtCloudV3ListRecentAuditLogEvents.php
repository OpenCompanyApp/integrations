<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Recent Audit Log Events.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/audit-logs/.
 */
class DbtCloudV3ListRecentAuditLogEvents extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_recent_audit_log_events';
    protected const DESCRIPTION = 'List Recent Audit Log Events

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/audit-logs/

Fetch paginated audit log events.

Note: This API is only available to enterprise customers.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/audit-logs/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
