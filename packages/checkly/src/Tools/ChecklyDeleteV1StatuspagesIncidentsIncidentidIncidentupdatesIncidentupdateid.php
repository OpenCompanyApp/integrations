<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes an incident update..
 *
 * Maps to the official Checkly endpoint DELETE /v1/status-pages/incidents/{incidentId}/incident-updates/{incidentUpdateId}.
 */
class ChecklyDeleteV1StatuspagesIncidentsIncidentidIncidentupdatesIncidentupdateid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_statuspages_incidents_incidentid_incidentupdates_incidentupdateid';
    protected const DESCRIPTION = 'Permanently removes an incident update.

Official Checkly endpoint: DELETE /v1/status-pages/incidents/{incidentId}/incident-updates/{incidentUpdateId}.';
    protected const PARAMETERS = array (
      'incident_id' => array (
        'type' => 'string',
        'description' => 'incidentId parameter.',
        'required' => true,
      ),
      'incident_update_id' => array (
        'type' => 'string',
        'description' => 'incidentUpdateId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/status-pages/incidents/{incidentId}/incident-updates/{incidentUpdateId}';
    protected const PATH_PARAMS = array (
      'incidentId' => 'incident_id',
      'incidentUpdateId' => 'incident_update_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
