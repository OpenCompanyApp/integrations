<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a communications stage.
 *
 * Maps to the official Rootly endpoint post /v1/communications/stages.
 */
class RootlyCreateCommunicationsStage extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_communications_stage';
    protected const DESCRIPTION = 'Creates a communications stage

Official Rootly endpoint: POST /v1/communications/stages

Creates a new communications stage from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/communications/stages';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
