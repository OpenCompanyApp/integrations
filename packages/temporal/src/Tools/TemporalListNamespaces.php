<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List namespaces.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces.
 */
class TemporalListNamespaces extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_namespaces';
    protected const DESCRIPTION = 'List namespaces

Official Temporal endpoint: GET /api/v1/namespaces

ListNamespaces returns the information and configuration for all namespaces.';
    protected const PARAMETERS = array (
  'page_size' => array (
  'type' => 'integer',
  'description' => 'pageSize parameter.',
),
  'next_page_token' => array (
  'type' => 'string',
  'description' => 'nextPageToken parameter.',
),
  'namespace_filter_include_deleted' => array (
  'type' => 'boolean',
  'description' => 'By default namespaces in NAMESPACE_STATE_DELETED state are not included.
 Setting include_deleted to true will include deleted namespaces.
 Note: Namespace is in NAMESPACE_STATE_DELETED state when it was deleted from the system but associated data is not deleted yet.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'pageSize' => 'page_size',
  'nextPageToken' => 'next_page_token',
  'namespaceFilter.includeDeleted' => 'namespace_filter_include_deleted',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
