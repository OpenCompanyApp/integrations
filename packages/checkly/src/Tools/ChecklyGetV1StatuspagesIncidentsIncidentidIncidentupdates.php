<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Lists all updates for a specific incident..
 *
 * Maps to the official Checkly endpoint GET /v1/status-pages/incidents/{incidentId}/incident-updates.
 */
class ChecklyGetV1StatuspagesIncidentsIncidentidIncidentupdates extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_statuspages_incidents_incidentid_incidentupdates';
    protected const DESCRIPTION = 'Lists all updates for a specific incident.

Official Checkly endpoint: GET /v1/status-pages/incidents/{incidentId}/incident-updates.';
    protected const PARAMETERS = array (
      'incident_id' => array (
        'type' => 'string',
        'description' => 'incidentId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/status-pages/incidents/{incidentId}/incident-updates';
    protected const PATH_PARAMS = array (
      'incidentId' => 'incident_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
