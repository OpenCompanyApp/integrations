<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete email templates.
 *
 * Maps to DELETE /api/email-templates in the official Logto OpenAPI source.
 */
class LogtoDeleteEmailTemplates extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_email_templates',
  'class' => 'LogtoDeleteEmailTemplates',
  'method' => 'DELETE',
  'path' => '/api/email-templates',
  'operation_id' => 'DeleteEmailTemplates',
  'summary' => 'Delete email templates',
  'description' => 'Bulk delete email templates by their language tag and template type.',
  'parameters' =>
  array (
    'language_tag' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The language tag of the email template, e.g., `en` or `fr`.',
    ),
    'template_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The type of the email template, e.g. `SignIn` or `ForgotPassword`',
      'enum' =>
      array (
        0 => 'SignIn',
        1 => 'Register',
        2 => 'ForgotPassword',
        3 => 'OrganizationInvitation',
        4 => 'Generic',
        5 => 'UserPermissionValidation',
        6 => 'BindNewIdentifier',
        7 => 'MfaVerification',
        8 => 'BindMfa',
      ),
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'languageTag' => 'language_tag',
    'templateType' => 'template_type',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
