<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get core v 1 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /api/v1/.
 */
class KubernetesGetCoreV1Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_core_v1_apiresources';
    protected const DESCRIPTION = 'Get core v 1 apiresources

Official Kubernetes endpoint: GET /api/v1/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
