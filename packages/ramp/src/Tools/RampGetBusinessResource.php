<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch the company information.
 *
 * Maps to the official Ramp endpoint get /developer/v1/business.
 */
class RampGetBusinessResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_business_resource';
    protected const DESCRIPTION = 'Fetch the company information

Official Ramp endpoint: GET /developer/v1/business';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/business';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
