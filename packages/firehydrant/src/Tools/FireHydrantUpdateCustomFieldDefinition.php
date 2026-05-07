<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a custom field definition.
 *
 * Maps to the official FireHydrant endpoint patch /v1/custom_fields/definitions/{field_id}.
 */
class FireHydrantUpdateCustomFieldDefinition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_custom_field_definition';
    protected const DESCRIPTION = 'Update a custom field definition

Official FireHydrant endpoint: PATCH /v1/custom_fields/definitions/{field_id}

Update a single custom field definition';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'description' => 'field_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/custom_fields/definitions/{field_id}';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
