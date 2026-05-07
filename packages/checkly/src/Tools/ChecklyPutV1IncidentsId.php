<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Updates an incident..
 *
 * Maps to the official Checkly endpoint PUT /v1/incidents/{id}.
 */
class ChecklyPutV1IncidentsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_incidents_id';
    protected const DESCRIPTION = 'Updates an incident.

Official Checkly endpoint: PUT /v1/incidents/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'probe' => array (
        'type' => 'boolean',
        'description' => 'probe parameter.',
        'required' => false,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/incidents/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'probe' => 'probe',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
