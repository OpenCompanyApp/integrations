<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Retrospective Process Group.
 *
 * Maps to the official Rootly endpoint get /v1/retrospective_process_groups/{id}.
 */
class RootlyGetRetrospectiveProcessGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_retrospective_process_group';
    protected const DESCRIPTION = 'Retrieves a Retrospective Process Group

Official Rootly endpoint: GET /v1/retrospective_process_groups/{id}

Retrieves a specific Retrospective Process Group by id';
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
    'description' => 'comma separated if needed. eg: retrospective_process_group_steps',
    'enum' =>
    array (
      0 => 'retrospective_process_group_steps',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/retrospective_process_groups/{id}';
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
