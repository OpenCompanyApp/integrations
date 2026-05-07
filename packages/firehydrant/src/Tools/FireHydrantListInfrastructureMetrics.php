<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get metrics for a component.
 *
 * Maps to the official FireHydrant endpoint get /v1/metrics/{infra_type}/{infra_id}.
 */
class FireHydrantListInfrastructureMetrics extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_infrastructure_metrics';
    protected const DESCRIPTION = 'Get metrics for a component

Official FireHydrant endpoint: GET /v1/metrics/{infra_type}/{infra_id}

Return metrics for a specific component';
    protected const PARAMETERS = array (
  'infra_type' =>
  array (
    'type' => 'string',
    'description' => 'infra_type parameter.',
    'required' => true,
    'enum' =>
    array (
      0 => 'environments',
      1 => 'functionalities',
      2 => 'services',
      3 => 'customers',
    ),
  ),
  'infra_id' =>
  array (
    'type' => 'string',
    'description' => 'Component UUID',
    'required' => true,
  ),
  'start_date' =>
  array (
    'type' => 'string',
    'description' => 'The start date to return metrics from; defaults to 30 days ago',
  ),
  'end_date' =>
  array (
    'type' => 'string',
    'description' => 'The end date to return metrics from, defaults to today',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/metrics/{infra_type}/{infra_id}';
    protected const PATH_PARAMS = array (
  'infra_type' => 'infra_type',
  'infra_id' => 'infra_id',
);
    protected const QUERY_PARAMS = array (
  'start_date' => 'start_date',
  'end_date' => 'end_date',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
