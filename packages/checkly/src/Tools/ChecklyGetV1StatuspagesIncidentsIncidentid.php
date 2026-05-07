<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get incident details including incident history and affected services..
 *
 * Maps to the official Checkly endpoint GET /v1/status-pages/incidents/{incidentId}.
 */
class ChecklyGetV1StatuspagesIncidentsIncidentid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_statuspages_incidents_incidentid';
    protected const DESCRIPTION = 'Get incident details including incident history and affected services.

Official Checkly endpoint: GET /v1/status-pages/incidents/{incidentId}.';
    protected const PARAMETERS = array (
      'incident_id' => array (
        'type' => 'string',
        'description' => 'incidentId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
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
