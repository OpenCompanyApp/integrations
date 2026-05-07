<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Shows details of a specific incident. Uses the "includeAllIncidentUpdates" query parameter to obtain all updates..
 *
 * Maps to the official Checkly endpoint GET /v1/incidents/{id}.
 */
class ChecklyGetV1IncidentsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_incidents_id';
    protected const DESCRIPTION = 'Shows details of a specific incident. Uses the "includeAllIncidentUpdates" query parameter to obtain all updates.

Official Checkly endpoint: GET /v1/incidents/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'include_all_incident_updates' => array (
        'type' => 'boolean',
        'description' => 'You use it to include all the incident updates.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/incidents/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'includeAllIncidentUpdates' => 'include_all_incident_updates',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
