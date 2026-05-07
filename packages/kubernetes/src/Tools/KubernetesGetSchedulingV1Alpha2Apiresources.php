<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get scheduling v 1 alpha 2 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /apis/scheduling.k8s.io/v1alpha2/.
 */
class KubernetesGetSchedulingV1Alpha2Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_scheduling_v1_alpha2_apiresources';
    protected const DESCRIPTION = 'Get scheduling v 1 alpha 2 apiresources

Official Kubernetes endpoint: GET /apis/scheduling.k8s.io/v1alpha2/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/scheduling.k8s.io/v1alpha2/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
