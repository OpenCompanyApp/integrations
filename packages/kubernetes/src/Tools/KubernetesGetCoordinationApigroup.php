<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get coordination apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/coordination.k8s.io/.
 */
class KubernetesGetCoordinationApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_coordination_apigroup';
    protected const DESCRIPTION = 'Get coordination apigroup

Official Kubernetes endpoint: GET /apis/coordination.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/coordination.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
