<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Introspect.
 *
 * Maps to POST /oauth2/introspect in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateIntrospect extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_introspect',
  'class' => 'FusionAuthCreateIntrospect',
  'method' => 'POST',
  'path' => '/oauth2/introspect',
  'operation_id' => 'createIntrospect',
  'summary' => 'create Introspect',
  'description' => 'Inspect an access token issued as the result of the Client Credentials Grant. OR Inspect an access token issued as the result of the Client Credentials Grant. OR Inspect an access token issued as the result of the User based grant such as the Authorization Code Grant, Implicit Grant, the User Credentials Grant or the Refresh Grant. OR Inspect an access token issued as the result of the User based grant such as the Authorization Code Grant, Implicit Grant, the User Credentials Grant or the Refres',
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
