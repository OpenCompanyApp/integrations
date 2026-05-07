<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create an attempt.
 *
 * Maps to the official WorkOS endpoint post /radar/attempts.
 */
class WorkOSRadarStandaloneAssess extends AbstractWorkOSTool
{
    protected const NAME = 'workos_radar_standalone_assess';
    protected const DESCRIPTION = 'Create an attempt

Official WorkOS endpoint: POST /radar/attempts

Assess a request for risk using the Radar engine and receive a verdict.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/radar/attempts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
