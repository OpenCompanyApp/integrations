<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Device Approve.
 *
 * Maps to POST /oauth2/device/approve in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateDeviceApprove extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_device_approve',
  'class' => 'FusionAuthCreateDeviceApprove',
  'method' => 'POST',
  'path' => '/oauth2/device/approve',
  'operation_id' => 'createDeviceApprove',
  'summary' => 'create Device Approve',
  'description' => 'Approve a device grant. OR Approve a device grant.',
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
