<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get resource apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/resource.k8s.io/.
 */
class KubernetesGetResourceApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_resource_apigroup';
    protected const DESCRIPTION = 'Get resource apigroup

Official Kubernetes endpoint: GET /apis/resource.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/resource.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
