<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an alert route.
 *
 * Maps to the official Rootly endpoint patch /v1/alert_routes/{id}.
 */
class RootlyPatchAlertRoute extends AbstractRootlyTool
{
    protected const NAME = 'rootly_patch_alert_route';
    protected const DESCRIPTION = 'Update an alert route

Official Rootly endpoint: PATCH /v1/alert_routes/{id}

Updates an alert route. **Note: This endpoint requires access to Advanced Alert Routing. If you\'re unsure whether you have access to this feature, please contact Rootly customer support.**';
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
    protected const METHOD = 'patch';
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
