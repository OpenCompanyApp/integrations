<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read rbac authorization v 1 cluster role binding.
 *
 * Maps to the official Kubernetes endpoint get /apis/rbac.authorization.k8s.io/v1/clusterrolebindings/{name}.
 */
class KubernetesReadRbacAuthorizationV1ClusterRoleBinding extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_rbac_authorization_v1_cluster_role_binding';
    protected const DESCRIPTION = 'Read rbac authorization v 1 cluster role binding

Official Kubernetes endpoint: GET /apis/rbac.authorization.k8s.io/v1/clusterrolebindings/{name}

read the specified ClusterRoleBinding';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the ClusterRoleBinding',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/rbac.authorization.k8s.io/v1/clusterrolebindings/{name}';
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
