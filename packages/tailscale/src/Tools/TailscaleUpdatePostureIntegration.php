<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Update a posture integration.
 *
 * Maps to the official Tailscale endpoint patch /posture/integrations/{id}.
 */
class TailscaleUpdatePostureIntegration extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_update_posture_integration';
    protected const DESCRIPTION = 'Update a posture integration

Official Tailscale endpoint: PATCH /posture/integrations/{id}

Updates the posture integration identified by `{id}`. You may omit the `clientSecret` from your request to retain the previously configured `clientSecret`.

OAuth Scope: `feature_settings`.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for a posture integration.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Tailscale API schema.',
  ),
);
    protected const METHOD = 'patch';
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
