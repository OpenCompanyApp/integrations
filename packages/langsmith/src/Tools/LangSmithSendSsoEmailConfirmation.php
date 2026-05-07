<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Send Sso Email Confirmation.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/sso/email-verification/send.
 */
class LangSmithSendSsoEmailConfirmation extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_send_sso_email_confirmation';
    protected const DESCRIPTION = 'Send Sso Email Confirmation

Official endpoint: POST /api/v1/sso/email-verification/send
Send an email to confirm the email address for an SSO user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/sso/email-verification/send';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
