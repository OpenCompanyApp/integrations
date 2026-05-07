<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List environments for a functionality.
 *
 * Maps to the official FireHydrant endpoint get /v1/functionalities/{functionality_id}/environments.
 */
class FireHydrantListFunctionalityEnvironments extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_functionality_environments';
    protected const DESCRIPTION = 'List environments for a functionality

Official FireHydrant endpoint: GET /v1/functionalities/{functionality_id}/environments

List environments for a functionality';
    protected const PARAMETERS = array (
  'functionality_id' =>
  array (
    'type' => 'string',
    'description' => 'functionality_id parameter.',
    'required' => true,
  ),
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
    protected const PATH = '/v1/functionalities/{functionality_id}/environments';
    protected const PATH_PARAMS = array (
  'functionality_id' => 'functionality_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
