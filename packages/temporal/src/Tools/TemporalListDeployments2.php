<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List deployments.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/deployments.
 */
class TemporalListDeployments2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_deployments_2';
    protected const DESCRIPTION = 'List deployments

Official Temporal endpoint: GET /namespaces/{namespace}/deployments

Lists worker deployments in the namespace. Optionally can filter based on deployment series
 name.
 Experimental. This API might significantly change or be removed in a future release.
 Deprecated. Replaced with `ListWorkerDeployments`.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'page_size' => array (
  'type' => 'integer',
  'description' => 'pageSize parameter.',
),
  'next_page_token' => array (
  'type' => 'string',
  'description' => 'nextPageToken parameter.',
),
  'series_name' => array (
  'type' => 'string',
  'description' => 'Optional. Use to filter based on exact series name match.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/deployments';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'pageSize' => 'page_size',
  'nextPageToken' => 'next_page_token',
  'seriesName' => 'series_name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
