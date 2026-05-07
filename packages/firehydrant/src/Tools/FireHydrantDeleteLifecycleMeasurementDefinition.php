<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive a measurement definition.
 *
 * Maps to the official FireHydrant endpoint delete /v1/lifecycles/measurement_definitions/{measurement_definition_id}.
 */
class FireHydrantDeleteLifecycleMeasurementDefinition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_lifecycle_measurement_definition';
    protected const DESCRIPTION = 'Archive a measurement definition

Official FireHydrant endpoint: DELETE /v1/lifecycles/measurement_definitions/{measurement_definition_id}

Archives a measurement definition which will hide it from lists and metrics';
    protected const PARAMETERS = array (
  'measurement_definition_id' =>
  array (
    'type' => 'string',
    'description' => 'measurement_definition_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
