<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Upsert Ttl Settings.
 *
 * Maps to the official LangSmith endpoint PUT /api/v1/orgs/ttl-settings.
 */
class LangSmithPutApiV1OrgsTtlSettings extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_put_api_v1_orgs_ttl_settings';
    protected const DESCRIPTION = 'Upsert Ttl Settings

Official endpoint: PUT /api/v1/orgs/ttl-settings
Upsert Ttl Settings.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/orgs/ttl-settings';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
