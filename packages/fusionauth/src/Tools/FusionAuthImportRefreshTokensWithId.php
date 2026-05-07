<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * import Refresh Tokens With Id.
 *
 * Maps to POST /api/user/refresh-token/import in the official FusionAuth OpenAPI document.
 */
class FusionAuthImportRefreshTokensWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_import_refresh_tokens_with_id',
  'class' => 'FusionAuthImportRefreshTokensWithId',
  'method' => 'POST',
  'path' => '/api/user/refresh-token/import',
  'operation_id' => 'importRefreshTokensWithId',
  'summary' => 'import Refresh Tokens With Id',
  'description' => 'Bulk imports refresh tokens. This request performs minimal validation and runs batch inserts of refresh tokens with the expectation that each token represents a user that already exists and is registered for the corresponding FusionAuth Application. This is done to increases the insert performance. Therefore, if you encounter an error due to a database key violation, the response will likely offer a generic explanation. If you encounter an error, you may optionally enable additional validation t',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
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
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
