<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Set Company Info.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/business-info.
 */
class LangSmithSetCompanyInfo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_set_company_info';
    protected const DESCRIPTION = 'Set Company Info

Official endpoint: POST /api/v1/orgs/current/business-info
Set Company Info.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/business-info';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
