<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a secret.
 *
 * Maps to the official Rootly endpoint delete /v1/secrets/{id}.
 */
class RootlyDeleteSecret extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_secret';
    protected const DESCRIPTION = 'Delete a secret

Official Rootly endpoint: DELETE /v1/secrets/{id}

Delete a specific secret by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/secrets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
