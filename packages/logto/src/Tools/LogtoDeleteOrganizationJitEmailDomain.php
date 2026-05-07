<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove organization JIT email domain.
 *
 * Maps to DELETE /api/organizations/{id}/jit/email-domains/{emailDomain} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationJitEmailDomain extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_jit_email_domain',
  'class' => 'LogtoDeleteOrganizationJitEmailDomain',
  'method' => 'DELETE',
  'path' => '/api/organizations/{id}/jit/email-domains/{emailDomain}',
  'operation_id' => 'DeleteOrganizationJitEmailDomain',
  'summary' => 'Remove organization JIT email domain',
  'description' => 'Remove an email domain for just-in-time provisioning of users in the organization.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'email_domain' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The email domain to remove.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'emailDomain' => 'email_domain',
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
