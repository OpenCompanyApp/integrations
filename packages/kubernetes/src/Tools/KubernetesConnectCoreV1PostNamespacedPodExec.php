<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Connect core v 1 post namespaced pod exec.
 *
 * Maps to the official Kubernetes endpoint post /api/v1/namespaces/{namespace}/pods/{name}/exec.
 */
class KubernetesConnectCoreV1PostNamespacedPodExec extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_connect_core_v1_post_namespaced_pod_exec';
    protected const DESCRIPTION = 'Connect core v 1 post namespaced pod exec

Official Kubernetes endpoint: POST /api/v1/namespaces/{namespace}/pods/{name}/exec

connect POST requests to exec of Pod';
    protected const PARAMETERS = array (
  'command' =>
  array (
    'type' => 'string',
    'description' => 'Command is the remote command to execute. argv array. Not executed within a shell.',
  ),
  'container' =>
  array (
    'type' => 'string',
    'description' => 'Container in which to execute the command. Defaults to only container if there is only one container in the pod.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PodExecOptions',
    'required' => true,
  ),
  'namespace' =>
  array (
    'type' => 'string',
    'description' => 'object name and auth scope, such as for teams and projects',
    'required' => true,
  ),
  'stderr' =>
  array (
    'type' => 'boolean',
    'description' => 'Redirect the standard error stream of the pod for this call.',
  ),
  'stdin' =>
  array (
    'type' => 'boolean',
    'description' => 'Redirect the standard input stream of the pod for this call. Defaults to false.',
  ),
  'stdout' =>
  array (
    'type' => 'boolean',
    'description' => 'Redirect the standard output stream of the pod for this call.',
  ),
  'tty' =>
  array (
    'type' => 'boolean',
    'description' => 'TTY if true indicates that a tty will be allocated for the exec call. Defaults to false.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/pods/{name}/exec';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'command' => 'command',
  'container' => 'container',
  'stderr' => 'stderr',
  'stdin' => 'stdin',
  'stdout' => 'stdout',
  'tty' => 'tty',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
