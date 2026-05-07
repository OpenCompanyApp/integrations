<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read certificates v 1 certificate signing request approval.
 *
 * Maps to the official Kubernetes endpoint get /apis/certificates.k8s.io/v1/certificatesigningrequests/{name}/approval.
 */
class KubernetesReadCertificatesV1CertificateSigningRequestApproval extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_certificates_v1_certificate_signing_request_approval';
    protected const DESCRIPTION = 'Read certificates v 1 certificate signing request approval

Official Kubernetes endpoint: GET /apis/certificates.k8s.io/v1/certificatesigningrequests/{name}/approval

read approval of the specified CertificateSigningRequest';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the CertificateSigningRequest',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/certificates.k8s.io/v1/certificatesigningrequests/{name}/approval';
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
