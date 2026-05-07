<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Modifies an incident update..
 *
 * Maps to the official Checkly endpoint PUT /v1/status-pages/incidents/{incidentId}/incident-updates/{incidentUpdateId}.
 */
class ChecklyPutV1StatuspagesIncidentsIncidentidIncidentupdatesIncidentupdateid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_statuspages_incidents_incidentid_incidentupdates_incidentupdateid';
    protected const DESCRIPTION = 'Modifies an incident update.

Official Checkly endpoint: PUT /v1/status-pages/incidents/{incidentId}/incident-updates/{incidentUpdateId}.';
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
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
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
