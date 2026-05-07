<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes an incident and all its updates..
 *
 * Maps to the official Checkly endpoint DELETE /v1/incidents/{id}.
 */
class ChecklyDeleteV1IncidentsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_incidents_id';
    protected const DESCRIPTION = 'Permanently removes an incident and all its updates.

Official Checkly endpoint: DELETE /v1/incidents/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/incidents/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
