<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Get an alert route.
 *
 * Maps to the official Rootly endpoint get /v1/alert_routes/{id}.
 */
class RootlyGetAlertRoute extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_alert_route';
    protected const DESCRIPTION = 'Get an alert route

Official Rootly endpoint: GET /v1/alert_routes/{id}

Get a specific alert route by id. **Note: This endpoint requires access to Advanced Alert Routing. If you\'re unsure whether you have access to this feature, please contact Rootly customer support.**

## Optional Parameters

- **show_nested_ids** (query parameter): When set to `true`, the response will include IDs for all nested resources (destinations, condition_groups, conditions). This is useful when you need to reference these nested resources for updates or deletions via PATCH requests.

Example: `GET /v1/alert_routes/{id}?show_nested_ids=true`';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alert_routes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
