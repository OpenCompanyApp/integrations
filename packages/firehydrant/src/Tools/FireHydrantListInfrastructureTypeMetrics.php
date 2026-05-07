<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List metrics for a component type.
 *
 * Maps to the official FireHydrant endpoint get /v1/metrics/{infra_type}.
 */
class FireHydrantListInfrastructureTypeMetrics extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_infrastructure_type_metrics';
    protected const DESCRIPTION = 'List metrics for a component type

Official FireHydrant endpoint: GET /v1/metrics/{infra_type}

Returns metrics for all components of a given type';
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
    protected const PATH = '/v1/metrics/{infra_type}';
    protected const PATH_PARAMS = array (
  'infra_type' => 'infra_type',
);
    protected const QUERY_PARAMS = array (
  'start_date' => 'start_date',
  'end_date' => 'end_date',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
