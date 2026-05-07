<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Delete Alert Sources V2.
 *
 * Maps to the official incident.io endpoint delete /v2/alert_sources/{id}.
 */
class IncidentIoAlertSourcesV2Delete extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_sources_v2_delete';
    protected const DESCRIPTION = 'Delete Alert Sources V2

Official incident.io endpoint: DELETE /v2/alert_sources/{id}

Delete an existing alert source in your account.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'The ID of this alert source',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v2/alert_sources/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
