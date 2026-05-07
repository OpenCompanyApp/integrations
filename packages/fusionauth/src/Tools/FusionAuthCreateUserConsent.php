<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create User Consent.
 *
 * Maps to POST /api/user/consent in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateUserConsent extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_user_consent',
  'class' => 'FusionAuthCreateUserConsent',
  'method' => 'POST',
  'path' => '/api/user/consent',
  'operation_id' => 'createUserConsent',
  'summary' => 'create User Consent',
  'description' => 'Creates a single User consent.',
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
