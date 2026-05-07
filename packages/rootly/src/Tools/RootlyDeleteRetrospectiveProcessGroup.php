<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a Retrospective Process Group.
 *
 * Maps to the official Rootly endpoint delete /v1/retrospective_process_groups/{id}.
 */
class RootlyDeleteRetrospectiveProcessGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_retrospective_process_group';
    protected const DESCRIPTION = 'Delete a Retrospective Process Group

Official Rootly endpoint: DELETE /v1/retrospective_process_groups/{id}

Delete a specific Retrospective Process Group by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/retrospective_process_groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
