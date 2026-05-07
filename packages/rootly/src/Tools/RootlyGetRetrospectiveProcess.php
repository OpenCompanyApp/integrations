<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a retrospective process.
 *
 * Maps to the official Rootly endpoint get /v1/retrospective_processes/{id}.
 */
class RootlyGetRetrospectiveProcess extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_retrospective_process';
    protected const DESCRIPTION = 'Retrieves a retrospective process

Official Rootly endpoint: GET /v1/retrospective_processes/{id}

Retrieves a specific retrospective process by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: retrospective_steps,severities',
    'enum' =>
    array (
      0 => 'retrospective_steps',
      1 => 'severities',
      2 => 'incident_types',
      3 => 'groups',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/retrospective_processes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
