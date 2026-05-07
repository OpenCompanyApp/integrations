<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * Version.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/cli/version.
 */
class PulumiMiscellaneousVersion extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_miscellaneous_version';
    protected const DESCRIPTION = 'Version

Official Pulumi Cloud endpoint: GET /api/cli/version

Returns version information about the CLI.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/cli/version';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
