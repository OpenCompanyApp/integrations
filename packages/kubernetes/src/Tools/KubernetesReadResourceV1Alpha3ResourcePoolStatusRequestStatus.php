<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read resource v 1 alpha 3 resource pool status request status.
 *
 * Maps to the official Kubernetes endpoint get /apis/resource.k8s.io/v1alpha3/resourcepoolstatusrequests/{name}/status.
 */
class KubernetesReadResourceV1Alpha3ResourcePoolStatusRequestStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_resource_v1_alpha3_resource_pool_status_request_status';
    protected const DESCRIPTION = 'Read resource v 1 alpha 3 resource pool status request status

Official Kubernetes endpoint: GET /apis/resource.k8s.io/v1alpha3/resourcepoolstatusrequests/{name}/status

read status of the specified ResourcePoolStatusRequest';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the ResourcePoolStatusRequest',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/resource.k8s.io/v1alpha3/resourcepoolstatusrequests/{name}/status';
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
