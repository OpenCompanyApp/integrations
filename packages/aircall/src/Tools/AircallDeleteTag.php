<?php

namespace OpenCompany\Integrations\Aircall\Tools;

/**
 * Delete a tag.
 */
class AircallDeleteTag extends AbstractAircallEndpointTool
{
    protected const TOOL_NAME = 'aircall_delete_tag';
    protected const TOOL_DESCRIPTION = 'Delete a tag.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/tags/{tag_id}';
    protected const PATH_KEYS = array (  0 => 'tag_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'tag_id' =>   array (    'type' => 'string',    'required' => true,    'description' => 'Aircall resource ID for tag id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
