<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Check Sso Email Verification Status.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/sso/email-verification/status.
 */
class LangSmithCheckSsoEmailVerificationStatus extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_check_sso_email_verification_status';
    protected const DESCRIPTION = 'Check Sso Email Verification Status

Official endpoint: POST /api/v1/sso/email-verification/status
Retrieve the email verification status of an SSO user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/sso/email-verification/status';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
