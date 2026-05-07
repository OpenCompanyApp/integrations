<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get hacker mode status.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/hacker_mode.
 */
class FireHydrantGetSignalsHackerMode extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_signals_hacker_mode';
    protected const DESCRIPTION = 'Get hacker mode status

Official FireHydrant endpoint: GET /v1/signals/hacker_mode

Get the status of the hacker mode for the current user';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/hacker_mode';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
