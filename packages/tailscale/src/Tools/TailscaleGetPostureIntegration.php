<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Get a posture integration.
 *
 * Maps to the official Tailscale endpoint get /posture/integrations/{id}.
 */
class TailscaleGetPostureIntegration extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_posture_integration';
    protected const DESCRIPTION = 'Get a posture integration

Official Tailscale endpoint: GET /posture/integrations/{id}

Gets the posture integration identified by `{id}`.

OAuth Scope: `feature_settings:read`.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for a posture integration.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/posture/integrations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
