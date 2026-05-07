<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get core apiversions.
 *
 * Maps to the official Kubernetes endpoint get /api/.
 */
class KubernetesGetCoreApiversions extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_core_apiversions';
    protected const DESCRIPTION = 'Get core apiversions

Official Kubernetes endpoint: GET /api/

get available API versions';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
