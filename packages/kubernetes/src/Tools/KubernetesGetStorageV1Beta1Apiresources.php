<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get storage v 1 beta 1 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /apis/storage.k8s.io/v1beta1/.
 */
class KubernetesGetStorageV1Beta1Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_storage_v1_beta1_apiresources';
    protected const DESCRIPTION = 'Get storage v 1 beta 1 apiresources

Official Kubernetes endpoint: GET /apis/storage.k8s.io/v1beta1/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/storage.k8s.io/v1beta1/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
