<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Updates a communications stage.
 *
 * Maps to the official Rootly endpoint patch /v1/communications/stages/{id}.
 */
class RootlyUpdateCommunicationsStage extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_communications_stage';
    protected const DESCRIPTION = 'Updates a communications stage

Official Rootly endpoint: PATCH /v1/communications/stages/{id}

Updates a communications stage';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Stage ID',
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
    protected const PATH = '/v1/communications/stages/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
