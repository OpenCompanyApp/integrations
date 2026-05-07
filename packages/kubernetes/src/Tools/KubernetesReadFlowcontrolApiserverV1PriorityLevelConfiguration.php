<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read flowcontrol apiserver v 1 priority level configuration.
 *
 * Maps to the official Kubernetes endpoint get /apis/flowcontrol.apiserver.k8s.io/v1/prioritylevelconfigurations/{name}.
 */
class KubernetesReadFlowcontrolApiserverV1PriorityLevelConfiguration extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_flowcontrol_apiserver_v1_priority_level_configuration';
    protected const DESCRIPTION = 'Read flowcontrol apiserver v 1 priority level configuration

Official Kubernetes endpoint: GET /apis/flowcontrol.apiserver.k8s.io/v1/prioritylevelconfigurations/{name}

read the specified PriorityLevelConfiguration';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PriorityLevelConfiguration',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/flowcontrol.apiserver.k8s.io/v1/prioritylevelconfigurations/{name}';
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
