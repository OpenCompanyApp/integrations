<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get signals report
 *
 * Maps to Fastly generated client operation NgwafReportsApi::getSignalsReport (GET /ngwaf/v1/reports/signals).
 */
class FastlyNgwafReportsGetSignalsReport extends AbstractFastlyTool
{
    protected const NAME = 'fastly_ngwaf_reports_get_signals_report';
    protected const DESCRIPTION = 'Get signals report

Official Fastly client operation: NgwafReportsApi::getSignalsReport
Endpoint: GET /ngwaf/v1/reports/signals

Get signals report';
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
  'signal_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `signal_type`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_ngwaf_reports_get_signals_report',
  'class' => 'FastlyNgwafReportsGetSignalsReport',
  'api_class' => 'NgwafReportsApi',
  'method_name' => 'getSignalsReport',
  'method' => 'GET',
  'path' => '/ngwaf/v1/reports/signals',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get signals report',
  'description' => 'Get signals report',
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
    'signal_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `signal_type`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'from' => 'from',
    'to' => 'to',
    'signal_type' => 'signal_type',
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
