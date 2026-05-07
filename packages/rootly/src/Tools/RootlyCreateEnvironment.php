<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an environment.
 *
 * Maps to the official Rootly endpoint post /v1/environments.
 */
class RootlyCreateEnvironment extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_environment';
    protected const DESCRIPTION = 'Creates an environment

Official Rootly endpoint: POST /v1/environments

Creates a new environment from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/environments';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
