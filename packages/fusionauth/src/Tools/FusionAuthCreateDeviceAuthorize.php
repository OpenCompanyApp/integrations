<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Device_authorize.
 *
 * Maps to POST /oauth2/device_authorize in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateDeviceAuthorize extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_device_authorize',
  'class' => 'FusionAuthCreateDeviceAuthorize',
  'method' => 'POST',
  'path' => '/oauth2/device_authorize',
  'operation_id' => 'createDevice_authorize',
  'summary' => 'create Device_authorize',
  'description' => 'Start the Device Authorization flow using a request body OR Start the Device Authorization flow using form-encoded parameters',
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
