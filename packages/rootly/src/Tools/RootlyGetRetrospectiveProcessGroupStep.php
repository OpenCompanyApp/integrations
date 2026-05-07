<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a RetrospectiveProcessGroup Step.
 *
 * Maps to the official Rootly endpoint get /v1/retrospective_process_group_steps/{id}.
 */
class RootlyGetRetrospectiveProcessGroupStep extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_retrospective_process_group_step';
    protected const DESCRIPTION = 'Retrieves a RetrospectiveProcessGroup Step

Official Rootly endpoint: GET /v1/retrospective_process_group_steps/{id}

Retrieves a specific RetrospectiveProcessGroup Step by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/retrospective_process_group_steps/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
