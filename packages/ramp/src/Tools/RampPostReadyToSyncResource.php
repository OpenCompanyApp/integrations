<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Post ready to sync status.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/ready-to-sync.
 */
class RampPostReadyToSyncResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_ready_to_sync_resource';
    protected const DESCRIPTION = 'Post ready to sync status

Official Ramp endpoint: POST /developer/v1/accounting/ready-to-sync

This endpoint allows customers to mark a list of objects as ready to sync by their object IDs.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/ready-to-sync';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
