<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a communications group.
 *
 * Maps to the official Rootly endpoint post /v1/communications/groups.
 */
class RootlyCreateCommunicationsGroup extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_communications_group';
    protected const DESCRIPTION = 'Creates a communications group

Official Rootly endpoint: POST /v1/communications/groups

Creates a new communications group from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/communications/groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
