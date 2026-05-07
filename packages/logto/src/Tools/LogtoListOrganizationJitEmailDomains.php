<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization JIT email domains.
 *
 * Maps to GET /api/organizations/{id}/jit/email-domains in the official Logto OpenAPI source.
 */
class LogtoListOrganizationJitEmailDomains extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_jit_email_domains',
  'class' => 'LogtoListOrganizationJitEmailDomains',
  'method' => 'GET',
  'path' => '/api/organizations/{id}/jit/email-domains',
  'operation_id' => 'ListOrganizationJitEmailDomains',
  'summary' => 'Get organization JIT email domains',
  'description' => 'Get email domains for just-in-time provisioning of users in the organization.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'page' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Page number (starts from 1).',
    ),
    'page_size' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Entries per page.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
    'page' => 'page',
    'page_size' => 'page_size',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
