<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a ticketing custom field.
 *
 * Maps to the official FireHydrant endpoint patch /v1/ticketing/custom_fields/definitions/{field_id}.
 */
class FireHydrantUpdateTicketingCustomDefinition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_ticketing_custom_definition';
    protected const DESCRIPTION = 'Update a ticketing custom field

Official FireHydrant endpoint: PATCH /v1/ticketing/custom_fields/definitions/{field_id}

Update a ticketing custom field for the organization';
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
    protected const PATH = '/v1/ticketing/custom_fields/definitions/{field_id}';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
