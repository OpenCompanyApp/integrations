<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Confirm Sso User Email.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/sso/email-verification/confirm.
 */
class LangSmithConfirmSsoUserEmail extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_confirm_sso_user_email';
    protected const DESCRIPTION = 'Confirm Sso User Email

Official endpoint: POST /api/v1/sso/email-verification/confirm
Confirm the email of an SSO user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/sso/email-verification/confirm';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
