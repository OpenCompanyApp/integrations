<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read core v 1 namespaced pod log.
 *
 * Maps to the official Kubernetes endpoint get /api/v1/namespaces/{namespace}/pods/{name}/log.
 */
class KubernetesReadCoreV1NamespacedPodLog extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_core_v1_namespaced_pod_log';
    protected const DESCRIPTION = 'Read core v 1 namespaced pod log

Official Kubernetes endpoint: GET /api/v1/namespaces/{namespace}/pods/{name}/log

read log of the specified Pod';
    protected const PARAMETERS = array (
  'container' =>
  array (
    'type' => 'string',
    'description' => 'The container for which to stream logs. Defaults to only container if there is one container in the pod.',
  ),
  'follow' =>
  array (
    'type' => 'boolean',
    'description' => 'Follow the log stream of the pod. Defaults to false.',
  ),
  'insecure_skip_tlsverify_backend' =>
  array (
    'type' => 'boolean',
    'description' => 'insecureSkipTLSVerifyBackend indicates that the apiserver should not confirm the validity of the serving certificate of the backend it is connecting to.  This will make the HTTPS connection between the apiserver and the backend insecure. This means the apiserver cannot verify the log data it is receiving came from the real kubelet.  If the kubelet is configured to verify the apiserver\'s TLS credentials, it does not mean the connection to the real kubelet is vulnerable to a man in the middle attack (e.g. an attacker could not intercept the actual log data coming from the real kubelet).',
  ),
  'limit_bytes' =>
  array (
    'type' => 'integer',
    'description' => 'If set, the number of bytes to read from the server before terminating the log output. This may not display a complete final line of logging, and may return slightly more or slightly less than the specified limit.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the Pod',
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
  'previous' =>
  array (
    'type' => 'boolean',
    'description' => 'Return previous terminated container logs. Defaults to false.',
  ),
  'since_seconds' =>
  array (
    'type' => 'integer',
    'description' => 'A relative time in seconds before the current time from which to show logs. If this value precedes the time a pod was started, only logs since the pod start will be returned. If this value is in the future, no logs will be returned. Only one of sinceSeconds or sinceTime may be specified.',
  ),
  'stream' =>
  array (
    'type' => 'string',
    'description' => 'Specify which container log stream to return to the client. Acceptable values are "All", "Stdout" and "Stderr". If not specified, "All" is used, and both stdout and stderr are returned interleaved. Note that when "TailLines" is specified, "Stream" can only be set to nil or "All".',
  ),
  'tail_lines' =>
  array (
    'type' => 'integer',
    'description' => 'If set, the number of lines from the end of the logs to show. If not specified, logs are shown from the creation of the container or sinceSeconds or sinceTime. Note that when "TailLines" is specified, "Stream" can only be set to nil or "All".',
  ),
  'timestamps' =>
  array (
    'type' => 'boolean',
    'description' => 'If true, add an RFC3339 or RFC3339Nano timestamp at the beginning of every line of log output. Defaults to false.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/pods/{name}/log';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'container' => 'container',
  'follow' => 'follow',
  'insecureSkipTLSVerifyBackend' => 'insecure_skip_tlsverify_backend',
  'limitBytes' => 'limit_bytes',
  'pretty' => 'pretty',
  'previous' => 'previous',
  'sinceSeconds' => 'since_seconds',
  'stream' => 'stream',
  'tailLines' => 'tail_lines',
  'timestamps' => 'timestamps',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
