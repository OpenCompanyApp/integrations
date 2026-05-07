<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * Capabilities.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/capabilities.
 */
class PulumiMiscellaneousCapabilities extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_miscellaneous_capabilities';
    protected const DESCRIPTION = 'Capabilities

Official Pulumi Cloud endpoint: GET /api/capabilities

Returns the set of capabilities that the service supports.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/capabilities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
