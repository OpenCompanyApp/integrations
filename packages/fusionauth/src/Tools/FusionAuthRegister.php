<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * register.
 *
 * Maps to POST /api/user/registration in the official FusionAuth OpenAPI document.
 */
class FusionAuthRegister extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_register',
  'class' => 'FusionAuthRegister',
  'method' => 'POST',
  'path' => '/api/user/registration',
  'operation_id' => 'register',
  'summary' => 'register',
  'description' => 'Registers a user for an application. If you provide the User and the UserRegistration object on this request, it will create the user as well as register them for the application. This is called a Full Registration. However, if you only provide the UserRegistration object, then the user must already exist and they will be registered for the application. The user Id can also be provided and it will either be used to look up an existing user or it will be used for the newly created User.',
  'parameters' =>
  array (
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
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
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
