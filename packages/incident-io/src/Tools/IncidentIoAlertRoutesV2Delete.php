<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Delete Alert Routes V2.
 *
 * Maps to the official incident.io endpoint delete /v2/alert_routes/{id}.
 */
class IncidentIoAlertRoutesV2Delete extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_routes_v2_delete';
    protected const DESCRIPTION = 'Delete Alert Routes V2

Official incident.io endpoint: DELETE /v2/alert_routes/{id}

Delete an existing alert route in your account.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier of the alert route',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v2/alert_routes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
