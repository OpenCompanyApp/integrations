<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a playbook.
 *
 * Maps to the official Rootly endpoint get /v1/playbooks/{id}.
 */
class RootlyGetPlaybook extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_playbook';
    protected const DESCRIPTION = 'Retrieves a playbook

Official Rootly endpoint: GET /v1/playbooks/{id}

Retrieves a specific playbook by id';
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
    'description' => 'comma separated if needed. eg: severities,environments,services',
    'enum' =>
    array (
      0 => 'severities',
      1 => 'environments',
      2 => 'services',
      3 => 'functionalities',
      4 => 'groups',
      5 => 'causes',
      6 => 'incident_types',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/playbooks/{id}';
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
