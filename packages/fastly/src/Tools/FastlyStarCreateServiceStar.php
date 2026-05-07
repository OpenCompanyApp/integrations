<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a star
 *
 * Maps to Fastly generated client operation StarApi::createServiceStar (POST /stars).
 */
class FastlyStarCreateServiceStar extends AbstractFastlyTool
{
    protected const NAME = 'fastly_star_create_service_star';
    protected const DESCRIPTION = 'Create a star

Official Fastly client operation: StarApi::createServiceStar
Endpoint: POST /stars

Create a star';
    protected const PARAMETERS = array (
  'star' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `star`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_star_create_service_star',
  'class' => 'FastlyStarCreateServiceStar',
  'api_class' => 'StarApi',
  'method_name' => 'createServiceStar',
  'method' => 'POST',
  'path' => '/stars',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a star',
  'description' => 'Create a star',
  'type' => 'write',
  'parameters' =>
  array (
    'star' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `star`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
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
  'form_params' =>
  array (
  ),
  'body_param' => 'star',
  'body_required' => false,
);
}
