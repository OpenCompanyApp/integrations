<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * send Family Request Email With Id.
 *
 * Maps to POST /api/user/family/request in the official FusionAuth OpenAPI document.
 */
class FusionAuthSendFamilyRequestEmailWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_send_family_request_email_with_id',
  'class' => 'FusionAuthSendFamilyRequestEmailWithId',
  'method' => 'POST',
  'path' => '/api/user/family/request',
  'operation_id' => 'sendFamilyRequestEmailWithId',
  'summary' => 'send Family Request Email With Id',
  'description' => 'Sends out an email to a parent that they need to register and create a family or need to log in and add a child to their existing family.',
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
