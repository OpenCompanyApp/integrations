<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Updates an incident..
 *
 * Maps to the official Checkly endpoint PUT /v1/status-pages/incidents/{incidentId}.
 */
class ChecklyPutV1StatuspagesIncidentsIncidentid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_statuspages_incidents_incidentid';
    protected const DESCRIPTION = 'Updates an incident.

Official Checkly endpoint: PUT /v1/status-pages/incidents/{incidentId}.';
    protected const PARAMETERS = array (
      'incident_id' => array (
        'type' => 'string',
        'description' => 'incidentId parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
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
