<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get code version.
 *
 * Maps to the official Kubernetes endpoint get /version/.
 */
class KubernetesGetCodeVersion extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_code_version';
    protected const DESCRIPTION = 'Get code version

Official Kubernetes endpoint: GET /version/

get the version information for this server';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/version/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
