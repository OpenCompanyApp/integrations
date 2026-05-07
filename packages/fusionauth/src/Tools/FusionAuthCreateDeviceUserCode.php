<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Device User Code.
 *
 * Maps to POST /oauth2/device/user-code in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateDeviceUserCode extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_device_user_code',
  'class' => 'FusionAuthCreateDeviceUserCode',
  'method' => 'POST',
  'path' => '/oauth2/device/user-code',
  'operation_id' => 'createDeviceUserCode',
  'summary' => 'create Device User Code',
  'description' => 'Retrieve a user_code that is part of an in-progress Device Authorization Grant. This API is useful if you want to build your own login workflow to complete a device grant. OR Retrieve a user_code that is part of an in-progress Device Authorization Grant. This API is useful if you want to build your own login workflow to complete a device grant. This request will require an API key.',
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
  'type' => 'write',
);
}
