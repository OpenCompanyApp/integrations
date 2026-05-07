<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Register Hub.
 *
 * Maps to the official Fivetran endpoint post /v1/hvr/register-hub.
 */
class FivetranHvrRegisterHub extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_hvr_register_hub';
    protected const DESCRIPTION = 'Register Hub

Official Fivetran endpoint: POST /v1/hvr/register-hub

Register a new hub within your Fivetran account.';
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
    protected const PATH = '/v1/hvr/register-hub';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
