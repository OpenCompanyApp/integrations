<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Create core v 1 namespaced service.
 *
 * Maps to the official Kubernetes endpoint post /api/v1/namespaces/{namespace}/services.
 */
class KubernetesCreateCoreV1NamespacedService extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_create_core_v1_namespaced_service';
    protected const DESCRIPTION = 'Create core v 1 namespaced service

Official Kubernetes endpoint: POST /api/v1/namespaces/{namespace}/services

create a Service';
    protected const PARAMETERS = array (
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Kubernetes object body matching the endpoint schema.',
    'required' => true,
  ),
  'dry_run' =>
  array (
    'type' => 'string',
    'description' => 'When present, indicates that modifications should not be persisted. An invalid or unrecognized dryRun directive will result in an error response and no further processing of the request. Valid values are: - All: all dry run stages will be processed',
  ),
  'field_manager' =>
  array (
    'type' => 'string',
    'description' => 'fieldManager is a name associated with the actor or entity that is making these changes. The value must be less than or 128 characters long, and only contain printable characters, as defined by https://golang.org/pkg/unicode/#IsPrint.',
  ),
  'field_validation' =>
  array (
    'type' => 'string',
    'description' => 'fieldValidation instructs the server on how to handle objects in the request (POST/PUT/PATCH) containing unknown or duplicate fields. Valid values are: - Ignore: This will ignore any unknown fields that are silently dropped from the object, and will ignore all but the last duplicate field that the decoder encounters. This is the default behavior prior to v1.23. - Warn: This will send a warning via the standard warning response header for each unknown field that is dropped from the object, and for each duplicate field that is encountered. The request will still succeed if there are no other errors, and will only persist the last of any duplicate fields. This is the default in v1.23+ - Strict: This will fail the request with a BadRequest error if any unknown fields would be dropped from the object, or if any duplicate fields are present. The error returned from the server will contain all unknown and duplicate fields encountered.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/services';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'pretty' => 'pretty',
  'dryRun' => 'dry_run',
  'fieldManager' => 'field_manager',
  'fieldValidation' => 'field_validation',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
