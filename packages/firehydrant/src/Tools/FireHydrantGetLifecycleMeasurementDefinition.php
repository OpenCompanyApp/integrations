<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a measurement definition.
 *
 * Maps to the official FireHydrant endpoint get /v1/lifecycles/measurement_definitions/{measurement_definition_id}.
 */
class FireHydrantGetLifecycleMeasurementDefinition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_lifecycle_measurement_definition';
    protected const DESCRIPTION = 'Get a measurement definition

Official FireHydrant endpoint: GET /v1/lifecycles/measurement_definitions/{measurement_definition_id}

Retrieve a single measurement definition from its ID';
    protected const PARAMETERS = array (
  'measurement_definition_id' =>
  array (
    'type' => 'string',
    'description' => 'measurement_definition_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/lifecycles/measurement_definitions/{measurement_definition_id}';
    protected const PATH_PARAMS = array (
  'measurement_definition_id' => 'measurement_definition_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
