<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Destroy Alert Attributes V2.
 *
 * Maps to the official incident.io endpoint delete /v2/alert_attributes/{id}.
 */
class IncidentIoAlertAttributesV2Destroy extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_attributes_v2_destroy';
    protected const DESCRIPTION = 'Destroy Alert Attributes V2

Official incident.io endpoint: DELETE /v2/alert_attributes/{id}

Destroy an alert attribute.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'The ID of this attribute',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v2/alert_attributes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
