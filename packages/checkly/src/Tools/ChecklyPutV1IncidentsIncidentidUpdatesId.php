<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Modifies an incident update..
 *
 * Maps to the official Checkly endpoint PUT /v1/incidents/{incidentId}/updates/{id}.
 */
class ChecklyPutV1IncidentsIncidentidUpdatesId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_incidents_incidentid_updates_id';
    protected const DESCRIPTION = 'Modifies an incident update.

Official Checkly endpoint: PUT /v1/incidents/{incidentId}/updates/{id}.';
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
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
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
