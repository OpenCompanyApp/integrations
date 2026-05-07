<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get severity matrix.
 *
 * Maps to the official FireHydrant endpoint get /v1/severity_matrix.
 */
class FireHydrantGetSeverityMatrix extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_severity_matrix';
    protected const DESCRIPTION = 'Get severity matrix

Official FireHydrant endpoint: GET /v1/severity_matrix

Retrieve the Severity matrix for your organization and its components and configured severities.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/severity_matrix';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
