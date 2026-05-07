<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List search attributes.
 *
 * Maps to the official Temporal endpoint get /cluster/namespaces/{namespace}/search-attributes.
 */
class TemporalListSearchAttributes2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_search_attributes_2';
    protected const DESCRIPTION = 'List search attributes

Official Temporal endpoint: GET /cluster/namespaces/{namespace}/search-attributes

ListSearchAttributes returns comprehensive information about search attributes.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/cluster/namespaces/{namespace}/search-attributes';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
