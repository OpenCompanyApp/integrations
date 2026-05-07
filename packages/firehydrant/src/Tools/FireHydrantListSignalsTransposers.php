<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List signal transposers.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/transposers.
 */
class FireHydrantListSignalsTransposers extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_signals_transposers';
    protected const DESCRIPTION = 'List signal transposers

Official FireHydrant endpoint: GET /v1/signals/transposers

List all transposers for your organization';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/transposers';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
