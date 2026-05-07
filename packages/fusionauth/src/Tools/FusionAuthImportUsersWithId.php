<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * import Users With Id.
 *
 * Maps to POST /api/user/import in the official FusionAuth OpenAPI document.
 */
class FusionAuthImportUsersWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_import_users_with_id',
  'class' => 'FusionAuthImportUsersWithId',
  'method' => 'POST',
  'path' => '/api/user/import',
  'operation_id' => 'importUsersWithId',
  'summary' => 'import Users With Id',
  'description' => 'Bulk imports users. This request performs minimal validation and runs batch inserts of users with the expectation that each user does not yet exist and each registration corresponds to an existing FusionAuth Application. This is done to increases the insert performance. Therefore, if you encounter an error due to a database key violation, the response will likely offer a generic explanation. If you encounter an error, you may optionally enable additional validation to receive a JSON response bod',
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
