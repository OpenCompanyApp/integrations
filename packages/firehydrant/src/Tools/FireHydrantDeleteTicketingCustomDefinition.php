<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a ticketing custom field.
 *
 * Maps to the official FireHydrant endpoint delete /v1/ticketing/custom_fields/definitions/{field_id}.
 */
class FireHydrantDeleteTicketingCustomDefinition extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_ticketing_custom_definition';
    protected const DESCRIPTION = 'Delete a ticketing custom field

Official FireHydrant endpoint: DELETE /v1/ticketing/custom_fields/definitions/{field_id}

Deletes a ticketing custom field for the organization';
    protected const PARAMETERS = array (
  'field_id' =>
  array (
    'type' => 'string',
    'description' => 'field_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/ticketing/custom_fields/definitions/{field_id}';
    protected const PATH_PARAMS = array (
  'field_id' => 'field_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
