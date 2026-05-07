<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes an incident update..
 *
 * Maps to the official Checkly endpoint DELETE /v1/incidents/{incidentId}/updates/{id}.
 */
class ChecklyDeleteV1IncidentsIncidentidUpdatesId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_incidents_incidentid_updates_id';
    protected const DESCRIPTION = 'Permanently removes an incident update.

Official Checkly endpoint: DELETE /v1/incidents/{incidentId}/updates/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'incident_id' => array (
        'type' => 'string',
        'description' => 'incidentId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/incidents/{incidentId}/updates/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
      'incidentId' => 'incident_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
