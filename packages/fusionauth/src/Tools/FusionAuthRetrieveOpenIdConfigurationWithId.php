<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Open Id Configuration With Id.
 *
 * Maps to GET /.well-known/openid-configuration in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveOpenIdConfigurationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_open_id_configuration_with_id',
  'class' => 'FusionAuthRetrieveOpenIdConfigurationWithId',
  'method' => 'GET',
  'path' => '/.well-known/openid-configuration',
  'operation_id' => 'retrieveOpenIdConfigurationWithId',
  'summary' => 'retrieve Open Id Configuration With Id',
  'description' => 'Returns the well known OpenID Configuration JSON document',
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
