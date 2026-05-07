<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates a communications type.
 *
 * Maps to the official Rootly endpoint post /v1/communications/types.
 */
class RootlyCreateCommunicationsType extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_communications_type';
    protected const DESCRIPTION = 'Creates a communications type

Official Rootly endpoint: POST /v1/communications/types

Creates a new communications type from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/communications/types';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
