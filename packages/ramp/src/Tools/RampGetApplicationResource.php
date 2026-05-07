<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a financing application.
 *
 * Maps to the official Ramp endpoint get /developer/v1/applications.
 */
class RampGetApplicationResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_application_resource';
    protected const DESCRIPTION = 'Fetch a financing application

Official Ramp endpoint: GET /developer/v1/applications

Since each business can only have one active financing application, this endpoint will only ever return a single application.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/applications';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
