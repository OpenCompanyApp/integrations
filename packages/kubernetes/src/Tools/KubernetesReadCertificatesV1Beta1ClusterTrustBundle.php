<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read certificates v 1 beta 1 cluster trust bundle.
 *
 * Maps to the official Kubernetes endpoint get /apis/certificates.k8s.io/v1beta1/clustertrustbundles/{name}.
 */
class KubernetesReadCertificatesV1Beta1ClusterTrustBundle extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_certificates_v1_beta1_cluster_trust_bundle';
    protected const DESCRIPTION = 'Read certificates v 1 beta 1 cluster trust bundle

Official Kubernetes endpoint: GET /apis/certificates.k8s.io/v1beta1/clustertrustbundles/{name}

read the specified ClusterTrustBundle';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the ClusterTrustBundle',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/certificates.k8s.io/v1beta1/clustertrustbundles/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
    protected const QUERY_PARAMS = array (
  'pretty' => 'pretty',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
