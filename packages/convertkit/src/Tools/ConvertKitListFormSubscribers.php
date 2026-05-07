<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

/**
 * List subscribers for a form.
 */
class ConvertKitListFormSubscribers extends AbstractConvertKitEndpointTool
{
    protected const TOOL_NAME = 'convertkit_list_form_subscribers';
    protected const TOOL_DESCRIPTION = 'List subscribers for a form.';
    protected const METHOD = 'GET';
    protected const PATH = '/forms/{form_id}/subscribers';
    protected const PATH_KEYS = array (  0 => 'form_id',);
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array ();
    protected const PARAMETERS = array (  'form_id' =>   array (    'type' => 'integer',    'required' => true,    'description' => 'Kit resource ID for form id.',  ),  'params' =>   array (    'type' => 'object',    'description' => 'Query parameters such as after, before, per_page, or include_total_count.',  ),);
    protected const DYNAMIC_PATH = false;
}
