<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Retrieve a tag.
 */
class AircallGetTag extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_get_tag';
    protected const TOOL_DESCRIPTION = 'Retrieve a tag.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/tags/{tag_id}';
    protected const PATH_KEYS = array (  0 => 'tag_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'tag_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for tag id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters.',  ),);
    protected const DYNAMIC_PATH = false;
}
