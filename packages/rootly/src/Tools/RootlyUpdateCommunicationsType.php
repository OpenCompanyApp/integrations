<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Updates a communications type.
 *
 * Maps to the official Rootly endpoint patch /v1/communications/types/{id}.
 */
class RootlyUpdateCommunicationsType extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_communications_type';
    protected const DESCRIPTION = 'Updates a communications type

Official Rootly endpoint: PATCH /v1/communications/types/{id}

Updates a communications type';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Type ID',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/communications/types/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
