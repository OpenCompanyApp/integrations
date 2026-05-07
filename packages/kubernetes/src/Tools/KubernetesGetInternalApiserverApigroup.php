<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get internal apiserver apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/internal.apiserver.k8s.io/.
 */
class KubernetesGetInternalApiserverApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_internal_apiserver_apigroup';
    protected const DESCRIPTION = 'Get internal apiserver apigroup

Official Kubernetes endpoint: GET /apis/internal.apiserver.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/internal.apiserver.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
