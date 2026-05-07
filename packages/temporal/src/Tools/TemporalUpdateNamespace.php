<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Update namespace.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/update.
 */
class TemporalUpdateNamespace extends AbstractTemporalTool
{
    protected const NAME = 'temporal_update_namespace';
    protected const DESCRIPTION = 'Update namespace

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/update

UpdateNamespace is used to update the information and configuration of a registered
 namespace.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/update';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
