<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Updates a communications group.
 *
 * Maps to the official Rootly endpoint patch /v1/communications/groups/{id}.
 */
class RootlyUpdateCommunicationsGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_communications_group';
    protected const DESCRIPTION = 'Updates a communications group

Official Rootly endpoint: PATCH /v1/communications/groups/{id}

Updates a communications group';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Group ID',
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
    protected const PATH = '/v1/communications/groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
