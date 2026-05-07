<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read rbac authorization v 1 namespaced role binding.
 *
 * Maps to the official Kubernetes endpoint get /apis/rbac.authorization.k8s.io/v1/namespaces/{namespace}/rolebindings/{name}.
 */
class KubernetesReadRbacAuthorizationV1NamespacedRoleBinding extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_rbac_authorization_v1_namespaced_role_binding';
    protected const DESCRIPTION = 'Read rbac authorization v 1 namespaced role binding

Official Kubernetes endpoint: GET /apis/rbac.authorization.k8s.io/v1/namespaces/{namespace}/rolebindings/{name}

read the specified RoleBinding';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the RoleBinding',
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
    protected const PATH = '/apis/rbac.authorization.k8s.io/v1/namespaces/{namespace}/rolebindings/{name}';
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
