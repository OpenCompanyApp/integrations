<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get admissionregistration v 1 beta 1 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /apis/admissionregistration.k8s.io/v1beta1/.
 */
class KubernetesGetAdmissionregistrationV1Beta1Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_admissionregistration_v1_beta1_apiresources';
    protected const DESCRIPTION = 'Get admissionregistration v 1 beta 1 apiresources

Official Kubernetes endpoint: GET /apis/admissionregistration.k8s.io/v1beta1/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/admissionregistration.k8s.io/v1beta1/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
