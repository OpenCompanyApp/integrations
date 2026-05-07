<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Organizations.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs.
 */
class LangSmithListOrganizations extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_organizations';
    protected const DESCRIPTION = 'List Organizations

Official endpoint: GET /api/v1/orgs
Get all orgs visible to this auth';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: skip_create, include_tier.',
  ),
  'skip_create' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `skip_create`.',
  ),
  'include_tier' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_tier`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'skip_create',
  1 => 'include_tier',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
