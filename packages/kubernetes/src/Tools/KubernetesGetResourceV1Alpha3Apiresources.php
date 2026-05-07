<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get resource v 1 alpha 3 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /apis/resource.k8s.io/v1alpha3/.
 */
class KubernetesGetResourceV1Alpha3Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_resource_v1_alpha3_apiresources';
    protected const DESCRIPTION = 'Get resource v 1 alpha 3 apiresources

Official Kubernetes endpoint: GET /apis/resource.k8s.io/v1alpha3/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/resource.k8s.io/v1alpha3/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
