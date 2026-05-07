<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Shows a communications type.
 *
 * Maps to the official Rootly endpoint get /v1/communications/types/{id}.
 */
class RootlyGetCommunicationsType extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_communications_type';
    protected const DESCRIPTION = 'Shows a communications type

Official Rootly endpoint: GET /v1/communications/types/{id}

Shows details of a communications type';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Type ID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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
