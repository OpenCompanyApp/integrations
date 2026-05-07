<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a priority.
 *
 * Maps to the official FireHydrant endpoint post /v1/priorities.
 */
class FireHydrantCreatePriority extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_priority';
    protected const DESCRIPTION = 'Create a priority

Official FireHydrant endpoint: POST /v1/priorities

Create a new priority';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/priorities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
