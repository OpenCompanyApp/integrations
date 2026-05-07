<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * FetchRestSpecification.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/openapi/pulumi-spec.json.
 */
class PulumiMiscellaneousFetchRestSpecification extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_miscellaneous_fetch_rest_specification';
    protected const DESCRIPTION = 'FetchRestSpecification

Official Pulumi Cloud endpoint: GET /api/openapi/pulumi-spec.json

Returns the OpenAPI v3 specification for the service.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/openapi/pulumi-spec.json';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
