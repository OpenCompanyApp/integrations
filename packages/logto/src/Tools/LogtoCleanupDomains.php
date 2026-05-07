<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Cleanup stale domains.
 *
 * Maps to POST /api/domains/cleanup in the official Logto OpenAPI source.
 */
class LogtoCleanupDomains extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_cleanup_domains',
  'class' => 'LogtoCleanupDomains',
  'method' => 'POST',
  'path' => '/api/domains/cleanup',
  'operation_id' => 'CleanupDomains',
  'summary' => 'Cleanup stale domains',
  'description' => 'Clean up custom domains that have been inactive (not verified) for a specified number of days. This uses Cloudflare as the source of truth to determine domain activity.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
