<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * forgot Password With Id.
 *
 * Maps to POST /api/user/forgot-password in the official FusionAuth OpenAPI document.
 */
class FusionAuthForgotPasswordWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_forgot_password_with_id',
  'class' => 'FusionAuthForgotPasswordWithId',
  'method' => 'POST',
  'path' => '/api/user/forgot-password',
  'operation_id' => 'forgotPasswordWithId',
  'summary' => 'forgot Password With Id',
  'description' => 'Begins the forgot password sequence, which kicks off an email to the user so that they can reset their password.',
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
