<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Shows a communications stage.
 *
 * Maps to the official Rootly endpoint get /v1/communications/stages/{id}.
 */
class RootlyGetCommunicationsStage extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_communications_stage';
    protected const DESCRIPTION = 'Shows a communications stage

Official Rootly endpoint: GET /v1/communications/stages/{id}

Shows details of a communications stage';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Communications Stage ID',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/communications/stages/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
