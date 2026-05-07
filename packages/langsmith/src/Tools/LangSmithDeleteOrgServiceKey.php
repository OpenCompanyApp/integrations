<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Org Service Key.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/orgs/current/service-keys/{api_key_id}.
 */
class LangSmithDeleteOrgServiceKey extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_org_service_key';
    protected const DESCRIPTION = 'Delete Org Service Key

Official endpoint: DELETE /api/v1/orgs/current/service-keys/{api_key_id}
Delete Org Service Key.';
    protected const PARAMETERS = array (
  'api_key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `api_key_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/orgs/current/service-keys/{api_key_id}';
    protected const PATH_PARAMS = array (
  0 => 'api_key_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
