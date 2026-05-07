<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Patch core v 1 namespaced pod template.
 *
 * Maps to the official Kubernetes endpoint patch /api/v1/namespaces/{namespace}/podtemplates/{name}.
 */
class KubernetesPatchCoreV1NamespacedPodTemplate extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_patch_core_v1_namespaced_pod_template';
    protected const DESCRIPTION = 'Patch core v 1 namespaced pod template

Official Kubernetes endpoint: PATCH /api/v1/namespaces/{namespace}/podtemplates/{name}

partially update the specified PodTemplate';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PodTemplate',
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
    'description' => 'fieldManager is a name associated with the actor or entity that is making these changes. The value must be less than or 128 characters long, and only contain printable characters, as defined by https://golang.org/pkg/unicode/#IsPrint. This field is required for apply requests (application/apply-patch) but optional for non-apply patch types (JsonPatch, MergePatch, StrategicMergePatch).',
  ),
  'field_validation' =>
  array (
    'type' => 'string',
    'description' => 'fieldValidation instructs the server on how to handle objects in the request (POST/PUT/PATCH) containing unknown or duplicate fields. Valid values are: - Ignore: This will ignore any unknown fields that are silently dropped from the object, and will ignore all but the last duplicate field that the decoder encounters. This is the default behavior prior to v1.23. - Warn: This will send a warning via the standard warning response header for each unknown field that is dropped from the object, and for each duplicate field that is encountered. The request will still succeed if there are no other errors, and will only persist the last of any duplicate fields. This is the default in v1.23+ - Strict: This will fail the request with a BadRequest error if any unknown fields would be dropped from the object, or if any duplicate fields are present. The error returned from the server will contain all unknown and duplicate fields encountered.',
  ),
  'force' =>
  array (
    'type' => 'boolean',
    'description' => 'Force is going to "force" Apply requests. It means user will re-acquire conflicting fields owned by other people. Force flag must be unset for non-apply patch requests.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/v1/namespaces/{namespace}/podtemplates/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'pretty' => 'pretty',
  'dryRun' => 'dry_run',
  'fieldManager' => 'field_manager',
  'fieldValidation' => 'field_validation',
  'force' => 'force',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
