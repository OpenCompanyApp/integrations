<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an environment.
 *
 * Maps to the official FireHydrant endpoint patch /v1/environments/{environment_id}.
 */
class FireHydrantUpdateEnvironment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_environment';
    protected const DESCRIPTION = 'Update an environment

Official FireHydrant endpoint: PATCH /v1/environments/{environment_id}

Update a environments attributes';
    protected const PARAMETERS = array (
  'environment_id' =>
  array (
    'type' => 'string',
    'description' => 'Environment UUID or slug',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/environments/{environment_id}';
    protected const PATH_PARAMS = array (
  'environment_id' => 'environment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
