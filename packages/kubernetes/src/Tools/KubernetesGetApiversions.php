<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get apiversions.
 *
 * Maps to the official Kubernetes endpoint get /apis/.
 */
class KubernetesGetApiversions extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_apiversions';
    protected const DESCRIPTION = 'Get apiversions

Official Kubernetes endpoint: GET /apis/

get available API versions';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
