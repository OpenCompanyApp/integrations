<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Replace organization JIT email domains.
 *
 * Maps to PUT /api/organizations/{id}/jit/email-domains in the official Logto OpenAPI source.
 */
class LogtoReplaceOrganizationJitEmailDomains extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_organization_jit_email_domains',
  'class' => 'LogtoReplaceOrganizationJitEmailDomains',
  'method' => 'PUT',
  'path' => '/api/organizations/{id}/jit/email-domains',
  'operation_id' => 'ReplaceOrganizationJitEmailDomains',
  'summary' => 'Replace organization JIT email domains',
  'description' => 'Replace all just-in-time provisioning email domains for the organization with the given data.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
