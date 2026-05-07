<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Update worker config.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/workers/update-config.
 */
class TemporalUpdateWorkerConfig2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_update_worker_config_2';
    protected const DESCRIPTION = 'Update worker config

Official Temporal endpoint: POST /namespaces/{namespace}/workers/update-config

UpdateWorkerConfig updates the worker configuration of one or more workers.
 Can be used to partially update the worker configuration.
 Can be used to update the configuration of multiple workers.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace this worker belongs to.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/workers/update-config';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
