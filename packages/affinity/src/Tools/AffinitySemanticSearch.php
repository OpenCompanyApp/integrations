<?php

namespace OpenCompany\Integrations\Affinity\Tools;

/**
 * Perform semantic search.
 */
class AffinitySemanticSearch extends AbstractAffinityEndpointTool
{
    protected const TOOL_NAME = 'affinity_semantic_search';
    protected const TOOL_DESCRIPTION = 'Perform semantic search.';
    protected const METHOD = 'POST';
    protected const PATH = '/semantic-search';
    protected const PATH_KEYS = array ();
    protected const QUERY_KEYS = array ();
    protected const BODY_KEYS = array (  0 => 'entity-type',  1 => 'query',  2 => 'filters',);
    protected const PARAMETERS = array (  'payload' =>   array (    'type' => 'object',    'description' => 'Full JSON request body. If provided, it overrides individual body fields.',  ),  'entity-type' =>   array (    'type' => 'string',    'description' => 'Body field: entity-type.',  ),  'query' =>   array (    'type' => 'string',    'description' => 'Body field: query.',  ),  'filters' =>   array (    'type' => 'array',    'description' => 'Body field: filters.',  ),);
    protected const DYNAMIC_PATH = false;
}
