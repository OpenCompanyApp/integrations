<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a custom field definition.
 *
 * Maps to the official FireHydrant endpoint post /v1/custom_fields/definitions.
 */
class FireHydrantCreateCustomFieldDefinition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_custom_field_definition';
    protected const DESCRIPTION = 'Create a custom field definition

Official FireHydrant endpoint: POST /v1/custom_fields/definitions

Create a new custom field definition';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/custom_fields/definitions';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
