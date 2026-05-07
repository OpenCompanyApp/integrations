<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Device Validate.
 *
 * Maps to GET /oauth2/device/validate in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveDeviceValidate extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_device_validate',
  'class' => 'FusionAuthRetrieveDeviceValidate',
  'method' => 'GET',
  'path' => '/oauth2/device/validate',
  'operation_id' => 'retrieveDeviceValidate',
  'summary' => 'retrieve Device Validate',
  'description' => 'Validates the end-user provided user_code from the user-interaction of the Device Authorization Grant. If you build your own activation form you should validate the user provided code prior to beginning the Authorization grant. OR Validates the end-user provided user_code from the user-interaction of the Device Authorization Grant. If you build your own activation form you should validate the user provided code prior to beginning the Authorization grant.',
  'parameters' =>
  array (
    'user_code' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The end-user verification code.',
    ),
    'client_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The client Id.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'user_code' => 'user_code',
    'client_id' => 'client_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
