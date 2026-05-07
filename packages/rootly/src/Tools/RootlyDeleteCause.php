<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a cause.
 *
 * Maps to the official Rootly endpoint delete /v1/causes/{id}.
 */
class RootlyDeleteCause extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_cause';
    protected const DESCRIPTION = 'Delete a cause

Official Rootly endpoint: DELETE /v1/causes/{id}

Delete a specific cause by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/causes/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
