<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get resource v 1 beta 2 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /apis/resource.k8s.io/v1beta2/.
 */
class KubernetesGetResourceV1Beta2Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_resource_v1_beta2_apiresources';
    protected const DESCRIPTION = 'Get resource v 1 beta 2 apiresources

Official Kubernetes endpoint: GET /apis/resource.k8s.io/v1beta2/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/resource.k8s.io/v1beta2/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
