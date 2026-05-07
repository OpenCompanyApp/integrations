<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Skip additional MFA suggestion.
 *
 * Maps to POST /api/experience/profile/mfa/mfa-suggestion-skipped in the official Logto OpenAPI source.
 */
class LogtoSkipMfaSuggestion extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_skip_mfa_suggestion',
  'class' => 'LogtoSkipMfaSuggestion',
  'method' => 'POST',
  'path' => '/api/experience/profile/mfa/mfa-suggestion-skipped',
  'operation_id' => 'SkipMfaSuggestion',
  'summary' => 'Skip additional MFA suggestion',
  'description' => 'Mark the optional additional MFA binding suggestion as skipped for the current interaction. When multiple MFA factors are enabled and only an email/phone factor is configured, a suggestion to add another factor may be shown; this endpoint records the choice to skip.',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
