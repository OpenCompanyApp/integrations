<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get discovery apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/discovery.k8s.io/.
 */
class KubernetesGetDiscoveryApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_discovery_apigroup';
    protected const DESCRIPTION = 'Get discovery apigroup

Official Kubernetes endpoint: GET /apis/discovery.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/discovery.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
