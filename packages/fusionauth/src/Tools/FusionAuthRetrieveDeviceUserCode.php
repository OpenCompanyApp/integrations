<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Device User Code.
 *
 * Maps to GET /oauth2/device/user-code in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveDeviceUserCode extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_device_user_code',
  'class' => 'FusionAuthRetrieveDeviceUserCode',
  'method' => 'GET',
  'path' => '/oauth2/device/user-code',
  'operation_id' => 'retrieveDeviceUserCode',
  'summary' => 'retrieve Device User Code',
  'description' => 'Retrieve a user_code that is part of an in-progress Device Authorization Grant. This API is useful if you want to build your own login workflow to complete a device grant. This request will require an API key. OR Retrieve a user_code that is part of an in-progress Device Authorization Grant. This API is useful if you want to build your own login workflow to complete a device grant.',
  'parameters' =>
  array (
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
  'content_type' => NULL,
  'type' => 'read',
);
}
