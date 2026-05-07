<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get batch v 1 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /apis/batch/v1/.
 */
class KubernetesGetBatchV1Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_batch_v1_apiresources';
    protected const DESCRIPTION = 'Get batch v 1 apiresources

Official Kubernetes endpoint: GET /apis/batch/v1/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/batch/v1/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
