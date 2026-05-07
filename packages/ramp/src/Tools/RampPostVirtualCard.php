<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a virtual card.
 *
 * Maps to the official Ramp endpoint post /developer/v1/cards/deferred/virtual.
 */
class RampPostVirtualCard extends AbstractRampTool
{
    protected const NAME = 'ramp_post_virtual_card';
    protected const DESCRIPTION = 'Create a virtual card

Official Ramp endpoint: POST /developer/v1/cards/deferred/virtual

Call this endpoint to create an async task to request for new virtual card.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/cards/deferred/virtual';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
