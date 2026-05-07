<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List Tenants.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/tenants.
 */
class LangSmithListTenants extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_list_tenants';
    protected const DESCRIPTION = 'List Tenants

Official endpoint: GET /api/v1/tenants
Get all tenants visible to this auth';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: skip_create, include_deleted.',
  ),
  'skip_create' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `skip_create`.',
  ),
  'include_deleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_deleted`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/tenants';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'skip_create',
  1 => 'include_deleted',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
