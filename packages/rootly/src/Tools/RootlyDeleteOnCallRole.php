<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an On-Call Role.
 *
 * Maps to the official Rootly endpoint delete /v1/on_call_roles/{id}.
 */
class RootlyDeleteOnCallRole extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_on_call_role';
    protected const DESCRIPTION = 'Delete an On-Call Role

Official Rootly endpoint: DELETE /v1/on_call_roles/{id}

Delete a specific On-Call Role by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/on_call_roles/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
