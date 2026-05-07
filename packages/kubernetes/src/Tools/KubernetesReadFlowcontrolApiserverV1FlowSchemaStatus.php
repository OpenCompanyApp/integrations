<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read flowcontrol apiserver v 1 flow schema status.
 *
 * Maps to the official Kubernetes endpoint get /apis/flowcontrol.apiserver.k8s.io/v1/flowschemas/{name}/status.
 */
class KubernetesReadFlowcontrolApiserverV1FlowSchemaStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_flowcontrol_apiserver_v1_flow_schema_status';
    protected const DESCRIPTION = 'Read flowcontrol apiserver v 1 flow schema status

Official Kubernetes endpoint: GET /apis/flowcontrol.apiserver.k8s.io/v1/flowschemas/{name}/status

read status of the specified FlowSchema';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the FlowSchema',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/flowcontrol.apiserver.k8s.io/v1/flowschemas/{name}/status';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
    protected const QUERY_PARAMS = array (
  'pretty' => 'pretty',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
