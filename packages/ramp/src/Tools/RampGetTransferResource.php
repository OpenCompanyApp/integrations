<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a transfer payment.
 *
 * Maps to the official Ramp endpoint get /developer/v1/transfers/{transfer_id}.
 */
class RampGetTransferResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_transfer_resource';
    protected const DESCRIPTION = 'Fetch a transfer payment

Official Ramp endpoint: GET /developer/v1/transfers/{transfer_id}

For information on how to use this endpoint, refer to the [Transfers Guide](/developer-api/v1/guides/transfers).';
    protected const PARAMETERS = array (
  'transfer_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `transfer_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/transfers/{transfer_id}';
    protected const PATH_PARAMS = array (
  'transfer_id' => 'transfer_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
