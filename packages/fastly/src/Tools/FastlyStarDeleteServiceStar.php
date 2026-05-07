<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a star
 *
 * Maps to Fastly generated client operation StarApi::deleteServiceStar (DELETE /stars/{star_id}).
 */
class FastlyStarDeleteServiceStar extends AbstractFastlyTool
{
    protected const NAME = 'fastly_star_delete_service_star';
    protected const DESCRIPTION = 'Delete a star

Official Fastly client operation: StarApi::deleteServiceStar
Endpoint: DELETE /stars/{star_id}

Delete a star';
    protected const PARAMETERS = array (
  'star_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `star_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_star_delete_service_star',
  'class' => 'FastlyStarDeleteServiceStar',
  'api_class' => 'StarApi',
  'method_name' => 'deleteServiceStar',
  'method' => 'DELETE',
  'path' => '/stars/{star_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a star',
  'description' => 'Delete a star',
  'type' => 'write',
  'parameters' =>
  array (
    'star_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `star_id`.',
    ),
  ),
  'path_params' =>
  array (
    'star_id' => 'star_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
