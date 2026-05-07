<?php

namespace OpenCompany\Integrations\Helicone\Tools;

/**
 * Create a gateway Responses API response.
 */
class HeliconeGatewayResponses extends AbstractHeliconeTool
{
    protected const NAME = 'helicone_gateway_responses';
    protected const DESCRIPTION = 'Create an OpenAI-compatible Responses API response through Helicone AI Gateway. Body must match /v1/responses.';
    protected const SERVICE_METHOD = 'gatewayResponses';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'OpenAI-compatible Responses API body.'],
    ];
}
