<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read admissionregistration v 1 mutating webhook configuration.
 *
 * Maps to the official Kubernetes endpoint get /apis/admissionregistration.k8s.io/v1/mutatingwebhookconfigurations/{name}.
 */
class KubernetesReadAdmissionregistrationV1MutatingWebhookConfiguration extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_admissionregistration_v1_mutating_webhook_configuration';
    protected const DESCRIPTION = 'Read admissionregistration v 1 mutating webhook configuration

Official Kubernetes endpoint: GET /apis/admissionregistration.k8s.io/v1/mutatingwebhookconfigurations/{name}

read the specified MutatingWebhookConfiguration';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the MutatingWebhookConfiguration',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/admissionregistration.k8s.io/v1/mutatingwebhookconfigurations/{name}';
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
