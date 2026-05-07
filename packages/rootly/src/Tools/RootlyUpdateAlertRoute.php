<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an alert route.
 *
 * Maps to the official Rootly endpoint put /v1/alert_routes/{id}.
 */
class RootlyUpdateAlertRoute extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_alert_route';
    protected const DESCRIPTION = 'Update an alert route

Official Rootly endpoint: PUT /v1/alert_routes/{id}

Update a specific alert route by id. **Note: This endpoint requires access to Advanced Alert Routing. If you\'re unsure whether you have access to this feature, please contact Rootly customer support.**

### Asynchronous Rule Creation

For organizations with large numbers of routing rules, Rootly supports asynchronous rule processing to improve performance. When enabled, rule updates happen in the background.

**Important**: When async processing is enabled, the rules list in the API response will not be up-to-date immediately after update. You should refetch the alert route after a few minutes to get the updated rules.

If you experience slow operations when managing alert routes with many rules, contact Rootly customer support to enable asynchronous rule processing for your organization.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/alert_routes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
