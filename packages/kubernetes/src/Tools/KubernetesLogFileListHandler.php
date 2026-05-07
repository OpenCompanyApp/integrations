<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Log file list handler.
 *
 * Maps to the official Kubernetes endpoint get /logs/.
 */
class KubernetesLogFileListHandler extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_log_file_list_handler';
    protected const DESCRIPTION = 'Log file list handler

Official Kubernetes endpoint: GET /logs/';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/logs/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
