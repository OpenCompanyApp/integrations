<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add organization JIT email domain.
 *
 * Maps to POST /api/organizations/{id}/jit/email-domains in the official Logto OpenAPI source.
 */
class LogtoCreateOrganizationJitEmailDomain extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_organization_jit_email_domain',
  'class' => 'LogtoCreateOrganizationJitEmailDomain',
  'method' => 'POST',
  'path' => '/api/organizations/{id}/jit/email-domains',
  'operation_id' => 'CreateOrganizationJitEmailDomain',
  'summary' => 'Add organization JIT email domain',
  'description' => 'Add a new email domain for just-in-time provisioning of users in the organization.',
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
