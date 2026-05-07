<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Create a System Key.
 *
 * Maps to the official Fivetran endpoint post /v1/system-keys.
 */
class FivetranCreateSystemKey extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_create_system_key';
    protected const DESCRIPTION = 'Create a System Key

Official Fivetran endpoint: POST /v1/system-keys

Creates a new system key with your Fivetran account.';
    protected const PARAMETERS = array (
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/system-keys';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
