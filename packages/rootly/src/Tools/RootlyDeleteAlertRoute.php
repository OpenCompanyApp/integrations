<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an alert route.
 *
 * Maps to the official Rootly endpoint delete /v1/alert_routes/{id}.
 */
class RootlyDeleteAlertRoute extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_alert_route';
    protected const DESCRIPTION = 'Delete an alert route

Official Rootly endpoint: DELETE /v1/alert_routes/{id}

Delete a specific alert route by id. **Note: This endpoint requires access to Advanced Alert Routing. If you\'re unsure whether you have access to this feature, please contact Rootly customer support.**';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
