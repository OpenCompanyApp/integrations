<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get scheduling apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/scheduling.k8s.io/.
 */
class KubernetesGetSchedulingApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_scheduling_apigroup';
    protected const DESCRIPTION = 'Get scheduling apigroup

Official Kubernetes endpoint: GET /apis/scheduling.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/scheduling.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
