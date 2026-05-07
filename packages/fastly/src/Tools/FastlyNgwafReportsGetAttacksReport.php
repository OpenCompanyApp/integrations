<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get attacks report
 *
 * Maps to Fastly generated client operation NgwafReportsApi::getAttacksReport (GET /ngwaf/v1/reports/attacks).
 */
class FastlyNgwafReportsGetAttacksReport extends AbstractFastlyTool
{
    protected const NAME = 'fastly_ngwaf_reports_get_attacks_report';
    protected const DESCRIPTION = 'Get attacks report

Official Fastly client operation: NgwafReportsApi::getAttacksReport
Endpoint: GET /ngwaf/v1/reports/attacks

Get attacks report';
    protected const PARAMETERS = array (
  'from' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `from`.',
  ),
  'to' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `to`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_ngwaf_reports_get_attacks_report',
  'class' => 'FastlyNgwafReportsGetAttacksReport',
  'api_class' => 'NgwafReportsApi',
  'method_name' => 'getAttacksReport',
  'method' => 'GET',
  'path' => '/ngwaf/v1/reports/attacks',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get attacks report',
  'description' => 'Get attacks report',
  'type' => 'read',
  'parameters' =>
  array (
    'from' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `from`.',
    ),
    'to' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `to`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'from' => 'from',
    'to' => 'to',
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
