<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an alert urgency.
 *
 * Maps to the official Rootly endpoint delete /v1/alert_urgencies/{id}.
 */
class RootlyDeleteAlertUrgency extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_alert_urgency';
    protected const DESCRIPTION = 'Delete an alert urgency

Official Rootly endpoint: DELETE /v1/alert_urgencies/{id}

Delete a specific alert urgency by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/alert_urgencies/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
