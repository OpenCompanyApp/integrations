<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Delete a posture integration.
 *
 * Maps to the official Tailscale endpoint delete /posture/integrations/{id}.
 */
class TailscaleDeletePostureIntegration extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_delete_posture_integration';
    protected const DESCRIPTION = 'Delete a posture integration

Official Tailscale endpoint: DELETE /posture/integrations/{id}

Delete a specific posture integration.

OAuth Scope: `feature_settings`.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique identifier for a posture integration.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
