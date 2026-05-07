<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * List Alerts V2.
 *
 * Maps to the official incident.io endpoint get /v2/alerts.
 */
class IncidentIoAlertsV2List extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alerts_v2_list';
    protected const DESCRIPTION = 'List Alerts V2

Official incident.io endpoint: GET /v2/alerts

List all alerts for your account.

This endpoint supports a number of filters, which can help find alerts matching certain
criteria. These filters work similarly to the filters on the incidents endpoint, where
a field is specified alongside a comparison operator in the query string.

Note that:
- Filters may be used together, and the result will be alerts that match all filters.
- All query parameters must be URI encoded.

### By deduplication_key

Find all alerts with deduplication_key ABC:

		curl --get \'https://api.incident.io/v2/alerts\' \\
			--data \'deduplication_key[is]=ABC\'

### By status

Find all alerts in a firing state:

		curl --get \'https://api.incident.io/v2/alerts\' \\
			--data \'status[one_of]=firing\'

### By alert_source

Find all alerts from a specific alert source (by alert source ID):

		curl --get \'https://api.incident.io/v2/alerts\' \\
			--data \'alert_source[one_of]=01GBSQF3FHF7FWZQNWGHAVQ804\'

Find all alerts not from a specific alert source:

		curl --get \'https://api.incident.io/v2/alerts\' \\
			--data \'alert_source[not_in]=01GBSQF3FHF7FWZQNWGHAVQ804\'

### By created_at
Find all alerts that follow specified date parameters for created_at field.
Possible values are "gte" (greater than or equal to), "lte" (less than or equal to), and
"date_range" (between two dates). The following example finds all alerts created after
2025-01-01:

		curl --get \'https://api.incident.io/v2/alerts\' \\
			--data \'created_at[gte]=2025-01-01\'

To find alerts created within a specific date range, use the date_range option with
tilde-separated dates:

		curl --get \'https://api.incident.io/v2/alerts\' \\
			--data \'created_at[date_range]=2024-12-02~2024-12-08\'

### Maintenance windows
By default, all alerts are returned including those held by a maintenance window.
To exclude alerts that are held by a maintenance window:

		curl --get \'https://api.incident.io/v2/alerts\' \\
			--data \'include_maintenance_window[is]=false\'';
    protected const PARAMETERS = array (
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'Number of alerts to return per page',
    'required' => true,
  ),
  'after' =>
  array (
    'type' => 'string',
    'description' => 'If provided, pass this as the \'after\' param to load the next page',
  ),
  'deduplication_key' =>
  array (
    'type' => 'object',
    'description' => 'Filter on alert deduplication key. The accepted operator is \'is\'.',
  ),
  'status' =>
  array (
    'type' => 'object',
    'description' => 'Filter on alert status. The accepted operators are \'one_of\', or \'not_in\'.',
  ),
  'alert_source' =>
  array (
    'type' => 'object',
    'description' => 'Filter on alert source by ID. The accepted operators are \'one_of\', or \'not_in\'.',
  ),
  'created_at' =>
  array (
    'type' => 'object',
    'description' => 'Filter on alert created at timestamp. Accepted operators are \'gte\', \'lte\' and \'date_range\'.',
  ),
  'include_maintenance_window' =>
  array (
    'type' => 'object',
    'description' => 'Filter on whether to include maintenance window alerts. The accepted operator is \'is\'.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/alerts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page_size' => 'page_size',
  'after' => 'after',
  'deduplication_key' => 'deduplication_key',
  'status' => 'status',
  'alert_source' => 'alert_source',
  'created_at' => 'created_at',
  'include_maintenance_window' => 'include_maintenance_window',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
