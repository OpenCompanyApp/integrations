<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates a new update for an incident..
 *
 * Maps to the official Checkly endpoint POST /v1/incidents/{incidentId}/updates.
 */
class ChecklyPostV1IncidentsIncidentidUpdates extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_incidents_incidentid_updates';
    protected const DESCRIPTION = 'Creates a new update for an incident.

Official Checkly endpoint: POST /v1/incidents/{incidentId}/updates.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/v1/incidents/{incidentId}/updates';
    protected const PATH_PARAMS = array (
      'incidentId' => 'incident_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
