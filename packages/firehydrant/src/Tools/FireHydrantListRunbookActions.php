<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List runbook actions.
 *
 * Maps to the official FireHydrant endpoint get /v1/runbooks/actions.
 */
class FireHydrantListRunbookActions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_runbook_actions';
    protected const DESCRIPTION = 'List runbook actions

Official FireHydrant endpoint: GET /v1/runbooks/actions

List all runbook actions available through your connected integrations';
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
  'type' =>
  array (
    'type' => 'string',
    'description' => 'List actions supporting this specific Runbook type',
  ),
  'lite' =>
  array (
    'type' => 'boolean',
    'description' => 'Boolean to determine whether to return a slimified version of the action object\'s integration',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/runbooks/actions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'type' => 'type',
  'lite' => 'lite',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
