<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Log file handler.
 *
 * Maps to the official Kubernetes endpoint get /logs/{logpath}.
 */
class KubernetesLogFileHandler extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_log_file_handler';
    protected const DESCRIPTION = 'Log file handler

Official Kubernetes endpoint: GET /logs/{logpath}';
    protected const PARAMETERS = array (
  'logpath' =>
  array (
    'type' => 'string',
    'description' => 'path to the log',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/logs/{logpath}';
    protected const PATH_PARAMS = array (
  'logpath' => 'logpath',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
