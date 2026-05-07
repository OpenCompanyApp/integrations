<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an alert route.
 *
 * Maps to the official Rootly endpoint post /v1/alert_routes.
 */
class RootlyCreateAlertRoute extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_alert_route';
    protected const DESCRIPTION = 'Creates an alert route

Official Rootly endpoint: POST /v1/alert_routes

Creates a new alert route from provided data. **Note: This endpoint requires access to Advanced Alert Routing. If you\'re unsure whether you have access to this feature, please contact Rootly customer support.**

## Asynchronous Rule Creation

For organizations with large numbers of routing rules, Rootly supports asynchronous rule processing to improve performance. When enabled, rule creation happens in the background.

**Important**: When async processing is enabled, the rules list in the API response will not be up-to-date immediately after creation. You should refetch the alert route after a few minutes to get the updated rules.

If you experience slow operations when managing alert routes with many rules, contact Rootly customer support to enable asynchronous rule processing for your organization.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alert_routes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
