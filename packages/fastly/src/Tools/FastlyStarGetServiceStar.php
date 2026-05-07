<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a star
 *
 * Maps to Fastly generated client operation StarApi::getServiceStar (GET /stars/{star_id}).
 */
class FastlyStarGetServiceStar extends AbstractFastlyTool
{
    protected const NAME = 'fastly_star_get_service_star';
    protected const DESCRIPTION = 'Get a star

Official Fastly client operation: StarApi::getServiceStar
Endpoint: GET /stars/{star_id}

Get a star';
    protected const PARAMETERS = array (
  'star_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `star_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_star_get_service_star',
  'class' => 'FastlyStarGetServiceStar',
  'api_class' => 'StarApi',
  'method_name' => 'getServiceStar',
  'method' => 'GET',
  'path' => '/stars/{star_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a star',
  'description' => 'Get a star',
  'type' => 'read',
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
