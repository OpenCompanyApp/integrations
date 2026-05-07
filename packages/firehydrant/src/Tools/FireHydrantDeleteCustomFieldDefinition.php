<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a custom field definition.
 *
 * Maps to the official FireHydrant endpoint delete /v1/custom_fields/definitions/{field_id}.
 */
class FireHydrantDeleteCustomFieldDefinition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_custom_field_definition';
    protected const DESCRIPTION = 'Delete a custom field definition

Official FireHydrant endpoint: DELETE /v1/custom_fields/definitions/{field_id}

Delete a custom field definition';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'description' => 'field_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/custom_fields/definitions/{field_id}';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
