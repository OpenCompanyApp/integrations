<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Lookup Sso By Email.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/sso/email-lookup.
 */
class LangSmithLookupSsoByEmail extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_lookup_sso_by_email';
    protected const DESCRIPTION = 'Lookup Sso By Email

Official endpoint: POST /api/v1/sso/email-lookup
Look up SSO providers available for a SCIM-provisioned email address.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/sso/email-lookup';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
