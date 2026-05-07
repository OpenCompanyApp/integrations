<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Application With Id.
 *
 * Maps to DELETE /api/application/{applicationId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteApplicationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_application_with_id',
  'class' => 'FusionAuthDeleteApplicationWithId',
  'method' => 'DELETE',
  'path' => '/api/application/{applicationId}',
  'operation_id' => 'deleteApplicationWithId',
  'summary' => 'delete Application With Id',
  'description' => 'Hard deletes an application. This is a dangerous operation and should not be used in most circumstances. This will delete the application, any registrations for that application, metrics and reports for the application, all the roles for the application, and any other data associated with the application. This operation could take a very long time, depending on the amount of data in your database. OR Deactivates the application with the given Id.',
  'parameters' =>
  array (
    'hard_delete' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `hardDelete`.',
    ),
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the application to delete.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
  ),
  'path_params' =>
  array (
    'applicationId' => 'application_id',
  ),
  'query_params' =>
  array (
    'hardDelete' => 'hard_delete',
  ),
  'header_params' =>
  array (
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
