<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Delete a custom field.
 *
 * Maps to the official Brex endpoint delete /v1/fields/{id}.
 */
class BrexFieldsDeleteField extends AbstractBrexTool
{
    protected const NAME = 'brex_fields_delete_field';
    protected const DESCRIPTION = 'Delete a custom field

Official Brex endpoint: DELETE /v1/fields/{id}

Delete a custom field by Brex ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
