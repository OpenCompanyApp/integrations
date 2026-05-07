<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get current deployment.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/current-deployment/{seriesName}.
 */
class TemporalGetCurrentDeployment2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_current_deployment_2';
    protected const DESCRIPTION = 'Get current deployment

Official Temporal endpoint: GET /namespaces/{namespace}/current-deployment/{seriesName}

Returns the current deployment (and its info) for a given deployment series.
 Experimental. This API might significantly change or be removed in a future release.
 Deprecated. Replaced by `current_version` returned by `DescribeWorkerDeployment`.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'series_name' => array (
  'type' => 'string',
  'description' => 'seriesName parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/current-deployment/{seriesName}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'seriesName' => 'series_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
