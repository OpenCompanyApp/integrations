<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read networking v 1 service cidrstatus.
 *
 * Maps to the official Kubernetes endpoint get /apis/networking.k8s.io/v1/servicecidrs/{name}/status.
 */
class KubernetesReadNetworkingV1ServiceCidrstatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_networking_v1_service_cidrstatus';
    protected const DESCRIPTION = 'Read networking v 1 service cidrstatus

Official Kubernetes endpoint: GET /apis/networking.k8s.io/v1/servicecidrs/{name}/status

read status of the specified ServiceCIDR';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the ServiceCIDR',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/networking.k8s.io/v1/servicecidrs/{name}/status';
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
