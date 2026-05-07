<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List priorities.
 *
 * Maps to the official FireHydrant endpoint get /v1/priorities.
 */
class FireHydrantListPriorities extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_priorities';
    protected const DESCRIPTION = 'List priorities

Official FireHydrant endpoint: GET /v1/priorities

Lists priorities';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/priorities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
