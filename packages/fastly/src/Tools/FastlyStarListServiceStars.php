<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List stars
 *
 * Maps to Fastly generated client operation StarApi::listServiceStars (GET /stars).
 */
class FastlyStarListServiceStars extends AbstractFastlyTool
{
    protected const NAME = 'fastly_star_list_service_stars';
    protected const DESCRIPTION = 'List stars

Official Fastly client operation: StarApi::listServiceStars
Endpoint: GET /stars

List stars';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_star_list_service_stars',
  'class' => 'FastlyStarListServiceStars',
  'api_class' => 'StarApi',
  'method_name' => 'listServiceStars',
  'method' => 'GET',
  'path' => '/stars',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List stars',
  'description' => 'List stars',
  'type' => 'read',
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
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
