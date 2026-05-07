<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a retrospective step.
 *
 * Maps to the official Rootly endpoint delete /v1/retrospective_steps/{id}.
 */
class RootlyDeleteRetrospectiveStep extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_retrospective_step';
    protected const DESCRIPTION = 'Delete a retrospective step

Official Rootly endpoint: DELETE /v1/retrospective_steps/{id}

Delete a specific retrospective step by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/retrospective_steps/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
