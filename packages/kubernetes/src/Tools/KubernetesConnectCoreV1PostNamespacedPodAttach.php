<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Connect core v 1 post namespaced pod attach.
 *
 * Maps to the official Kubernetes endpoint post /api/v1/namespaces/{namespace}/pods/{name}/attach.
 */
class KubernetesConnectCoreV1PostNamespacedPodAttach extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_connect_core_v1_post_namespaced_pod_attach';
    protected const DESCRIPTION = 'Connect core v 1 post namespaced pod attach

Official Kubernetes endpoint: POST /api/v1/namespaces/{namespace}/pods/{name}/attach

connect POST requests to attach of Pod';
    protected const PARAMETERS = array (
  'container' =>
  array (
    'type' => 'string',
    'description' => 'The container in which to execute the command. Defaults to only container if there is only one container in the pod.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PodAttachOptions',
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
    'description' => 'Stderr if true indicates that stderr is to be redirected for the attach call. Defaults to true.',
  ),
  'stdin' =>
  array (
    'type' => 'boolean',
    'description' => 'Stdin if true, redirects the standard input stream of the pod for this call. Defaults to false.',
  ),
  'stdout' =>
  array (
    'type' => 'boolean',
    'description' => 'Stdout if true indicates that stdout is to be redirected for the attach call. Defaults to true.',
  ),
  'tty' =>
  array (
    'type' => 'boolean',
    'description' => 'TTY if true indicates that a tty will be allocated for the attach call. This is passed through the container runtime so the tty is allocated on the worker node by the container runtime. Defaults to false.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/pods/{name}/attach';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
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
