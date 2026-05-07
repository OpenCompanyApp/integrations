<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Deletes a communications type.
 *
 * Maps to the official Rootly endpoint delete /v1/communications/types/{id}.
 */
class RootlyDeleteCommunicationsType extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_communications_type';
    protected const DESCRIPTION = 'Deletes a communications type

Official Rootly endpoint: DELETE /v1/communications/types/{id}

Deletes a communications type';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Type ID',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/communications/types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
