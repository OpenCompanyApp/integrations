<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create an environment.
 *
 * Maps to the official FireHydrant endpoint post /v1/environments.
 */
class FireHydrantCreateEnvironment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_environment';
    protected const DESCRIPTION = 'Create an environment

Official FireHydrant endpoint: POST /v1/environments

Creates an environment for the organization';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
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
