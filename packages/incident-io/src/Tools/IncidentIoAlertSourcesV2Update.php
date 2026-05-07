<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Update Alert Sources V2.
 *
 * Maps to the official incident.io endpoint put /v2/alert_sources/{id}.
 */
class IncidentIoAlertSourcesV2Update extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_alert_sources_v2_update';
    protected const DESCRIPTION = 'Update Alert Sources V2

Official incident.io endpoint: PUT /v2/alert_sources/{id}

Update an existing alert source in your account.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'The ID of this alert source',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v2/alert_sources/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
