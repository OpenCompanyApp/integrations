<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List select options for a runbook integration action field.
 *
 * Maps to the official FireHydrant endpoint get /v1/runbooks/select_options/{integration_slug}/{action_slug}/{field}.
 */
class FireHydrantGetRunbookActionFieldOptions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_runbook_action_field_options';
    protected const DESCRIPTION = 'List select options for a runbook integration action field

Official FireHydrant endpoint: GET /v1/runbooks/select_options/{integration_slug}/{action_slug}/{field}

List select options for a runbook integration action field';
    protected const PARAMETERS = array (
  'integration_slug' =>
  array (
    'type' => 'string',
    'description' => 'integration_slug parameter.',
    'required' => true,
  ),
  'action_slug' =>
  array (
    'type' => 'string',
    'description' => 'action_slug parameter.',
    'required' => true,
  ),
  'field' =>
  array (
    'type' => 'string',
    'description' => 'field parameter.',
    'required' => true,
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'Text string of a query for filtering values.',
  ),
  'scope' =>
  array (
    'type' => 'string',
    'description' => 'Generic params used to add specificity (eg an id of some kind) to the select options request',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'Maximum number of items to return.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/runbooks/select_options/{integration_slug}/{action_slug}/{field}';
    protected const PATH_PARAMS = array (
  'integration_slug' => 'integration_slug',
  'action_slug' => 'action_slug',
  'field' => 'field',
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
  'scope' => 'scope',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
