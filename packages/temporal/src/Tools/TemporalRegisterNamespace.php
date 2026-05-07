<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Register namespace.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces.
 */
class TemporalRegisterNamespace extends AbstractTemporalTool
{
    protected const NAME = 'temporal_register_namespace';
    protected const DESCRIPTION = 'Register namespace

Official Temporal endpoint: POST /api/v1/namespaces

RegisterNamespace creates a new namespace which can be used as a container for all resources.

 A Namespace is a top level entity within Temporal, and is used as a container for resources
 like workflow executions, task queues, etc. A Namespace acts as a sandbox and provides
 isolation for all resources within the namespace. All resources belongs to exactly one
 namespace.';
    protected const PARAMETERS = array (
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
