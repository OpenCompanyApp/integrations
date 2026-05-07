<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get certificates apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/certificates.k8s.io/.
 */
class KubernetesGetCertificatesApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_certificates_apigroup';
    protected const DESCRIPTION = 'Get certificates apigroup

Official Kubernetes endpoint: GET /apis/certificates.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/certificates.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
