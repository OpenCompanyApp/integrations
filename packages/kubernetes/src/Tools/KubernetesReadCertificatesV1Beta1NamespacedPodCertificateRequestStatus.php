<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read certificates v 1 beta 1 namespaced pod certificate request status.
 *
 * Maps to the official Kubernetes endpoint get /apis/certificates.k8s.io/v1beta1/namespaces/{namespace}/podcertificaterequests/{name}/status.
 */
class KubernetesReadCertificatesV1Beta1NamespacedPodCertificateRequestStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_certificates_v1_beta1_namespaced_pod_certificate_request_status';
    protected const DESCRIPTION = 'Read certificates v 1 beta 1 namespaced pod certificate request status

Official Kubernetes endpoint: GET /apis/certificates.k8s.io/v1beta1/namespaces/{namespace}/podcertificaterequests/{name}/status

read status of the specified PodCertificateRequest';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PodCertificateRequest',
    'required' => true,
  ),
  'namespace' =>
  array (
    'type' => 'string',
    'description' => 'object name and auth scope, such as for teams and projects',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/certificates.k8s.io/v1beta1/namespaces/{namespace}/podcertificaterequests/{name}/status';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'pretty' => 'pretty',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
