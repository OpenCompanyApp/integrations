<?php

namespace OpenCompany\Integrations\Helicone\Tools;

/**
 * List models available through the Helicone AI Gateway.
 */
class HeliconeListGatewayModels extends AbstractHeliconeTool
{
    protected const NAME = 'helicone_list_gateway_models';
    protected const DESCRIPTION = 'List models available through the OpenAI-compatible Helicone AI Gateway.';
    protected const SERVICE_METHOD = 'listGatewayModels';
    protected const MODE = 'none';
    protected const PARAMETERS = [];
}
