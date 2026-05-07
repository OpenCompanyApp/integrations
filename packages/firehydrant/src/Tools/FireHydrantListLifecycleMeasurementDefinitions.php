<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List measurement definitions.
 *
 * Maps to the official FireHydrant endpoint get /v1/lifecycles/measurement_definitions.
 */
class FireHydrantListLifecycleMeasurementDefinitions extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_lifecycle_measurement_definitions';
    protected const DESCRIPTION = 'List measurement definitions

Official FireHydrant endpoint: GET /v1/lifecycles/measurement_definitions

List all of the measurement definitions in the organization';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/lifecycles/measurement_definitions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
