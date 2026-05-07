<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Post sync status.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/syncs.
 */
class RampPostSyncListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_sync_list_resource';
    protected const DESCRIPTION = 'Post sync status

Official Ramp endpoint: POST /developer/v1/accounting/syncs

This endpoint allows customers to notify Ramp of a list of sync results. An idempotency key is required to ensure that subsequent requests are properly handled.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/syncs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
