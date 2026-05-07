<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * activate Reactor With Id.
 *
 * Maps to POST /api/reactor in the official FusionAuth OpenAPI document.
 */
class FusionAuthActivateReactorWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_activate_reactor_with_id',
  'class' => 'FusionAuthActivateReactorWithId',
  'method' => 'POST',
  'path' => '/api/reactor',
  'operation_id' => 'activateReactorWithId',
  'summary' => 'activate Reactor With Id',
  'description' => 'Activates the FusionAuth Reactor using a license Id and optionally a license text (for air-gapped deployments)',
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
