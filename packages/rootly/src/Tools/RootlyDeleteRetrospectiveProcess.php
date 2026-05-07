<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a retrospective process.
 *
 * Maps to the official Rootly endpoint delete /v1/retrospective_processes/{id}.
 */
class RootlyDeleteRetrospectiveProcess extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_retrospective_process';
    protected const DESCRIPTION = 'Delete a retrospective process

Official Rootly endpoint: DELETE /v1/retrospective_processes/{id}

Delete a specific retrospective process by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/retrospective_processes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
