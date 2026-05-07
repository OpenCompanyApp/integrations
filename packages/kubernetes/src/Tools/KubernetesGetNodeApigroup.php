<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get node apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/node.k8s.io/.
 */
class KubernetesGetNodeApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_node_apigroup';
    protected const DESCRIPTION = 'Get node apigroup

Official Kubernetes endpoint: GET /apis/node.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/node.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
