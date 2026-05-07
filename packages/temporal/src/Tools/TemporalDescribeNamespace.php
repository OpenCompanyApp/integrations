<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe namespace.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}.
 */
class TemporalDescribeNamespace extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_namespace';
    protected const DESCRIPTION = 'Describe namespace

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}

DescribeNamespace returns the information and configuration for a registered namespace.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'id' => array (
  'type' => 'string',
  'description' => 'id parameter.',
),
  'weak_consistency' => array (
  'type' => 'boolean',
  'description' => 'If true, the server may serve the response from an eventually-consistent
 source instead of reading through to persistence. Defaults to false,
 which preserves read-after-write consistency. SDKs should set this when
 fetching namespace capabilities on worker/client startup.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'id' => 'id',
  'weakConsistency' => 'weak_consistency',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
