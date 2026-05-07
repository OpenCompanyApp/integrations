<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Fastly POPs
 *
 * Maps to Fastly generated client operation PopApi::listPops (GET /datacenters).
 */
class FastlyPopListPops extends AbstractFastlyTool
{
    protected const NAME = 'fastly_pop_list_pops';
    protected const DESCRIPTION = 'List Fastly POPs

Official Fastly client operation: PopApi::listPops
Endpoint: GET /datacenters

List Fastly POPs';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_pop_list_pops',
  'class' => 'FastlyPopListPops',
  'api_class' => 'PopApi',
  'method_name' => 'listPops',
  'method' => 'GET',
  'path' => '/datacenters',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Fastly POPs',
  'description' => 'List Fastly POPs',
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
