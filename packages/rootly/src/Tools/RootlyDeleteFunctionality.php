<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a functionality.
 *
 * Maps to the official Rootly endpoint delete /v1/functionalities/{id}.
 */
class RootlyDeleteFunctionality extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_functionality';
    protected const DESCRIPTION = 'Delete a functionality

Official Rootly endpoint: DELETE /v1/functionalities/{id}

Delete a specific functionality by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/functionalities/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
