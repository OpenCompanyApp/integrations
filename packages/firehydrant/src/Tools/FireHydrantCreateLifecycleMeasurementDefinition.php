<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a measurement definition.
 *
 * Maps to the official FireHydrant endpoint post /v1/lifecycles/measurement_definitions.
 */
class FireHydrantCreateLifecycleMeasurementDefinition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_lifecycle_measurement_definition';
    protected const DESCRIPTION = 'Create a measurement definition

Official FireHydrant endpoint: POST /v1/lifecycles/measurement_definitions

Create a new measurement definition';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/lifecycles/measurement_definitions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
