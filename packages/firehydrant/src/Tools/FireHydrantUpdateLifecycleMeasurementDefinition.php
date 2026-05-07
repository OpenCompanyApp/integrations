<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a measurement definition.
 *
 * Maps to the official FireHydrant endpoint patch /v1/lifecycles/measurement_definitions/{measurement_definition_id}.
 */
class FireHydrantUpdateLifecycleMeasurementDefinition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_lifecycle_measurement_definition';
    protected const DESCRIPTION = 'Update a measurement definition

Official FireHydrant endpoint: PATCH /v1/lifecycles/measurement_definitions/{measurement_definition_id}

Update a single measurement definition from its ID';
    protected const PARAMETERS = array (
  'measurement_definition_id' =>
  array (
    'type' => 'string',
    'description' => 'measurement_definition_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'patch';
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
