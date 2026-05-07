<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * Remove a tag from a subscriber by ID.
 */
class ConvertKitRemoveTagFromSubscriber extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_remove_tag_from_subscriber';
    protected const TOOL_DESCRIPTION = 'Remove a tag from a subscriber by ID.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/tags/{tag_id}/subscribers/{id}';
    protected const PATH_KEYS = array (  0 => 'tag_id',  1 => 'id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'tag_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for tag id.',  ),  'id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for id.',  ),  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),);
    protected const DYNAMIC_PATH = false;
}
