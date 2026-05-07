<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read rbac authorization v 1 namespaced role.
 *
 * Maps to the official Kubernetes endpoint get /apis/rbac.authorization.k8s.io/v1/namespaces/{namespace}/roles/{name}.
 */
class KubernetesReadRbacAuthorizationV1NamespacedRole extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_rbac_authorization_v1_namespaced_role';
    protected const DESCRIPTION = 'Read rbac authorization v 1 namespaced role

Official Kubernetes endpoint: GET /apis/rbac.authorization.k8s.io/v1/namespaces/{namespace}/roles/{name}

read the specified Role';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the Role',
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
    protected const PATH = '/apis/rbac.authorization.k8s.io/v1/namespaces/{namespace}/roles/{name}';
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
