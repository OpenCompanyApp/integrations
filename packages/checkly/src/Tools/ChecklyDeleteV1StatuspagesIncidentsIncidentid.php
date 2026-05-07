<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes an incident and all its updates..
 *
 * Maps to the official Checkly endpoint DELETE /v1/status-pages/incidents/{incidentId}.
 */
class ChecklyDeleteV1StatuspagesIncidentsIncidentid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_statuspages_incidents_incidentid';
    protected const DESCRIPTION = 'Permanently removes an incident and all its updates.

Official Checkly endpoint: DELETE /v1/status-pages/incidents/{incidentId}.';
    protected const PARAMETERS = array (
      'incident_id' => array (
        'type' => 'string',
        'description' => 'incidentId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/status-pages/incidents/{incidentId}';
    protected const PATH_PARAMS = array (
      'incidentId' => 'incident_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
