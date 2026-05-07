<?php

namespace OpenCompany\Integrations\Helicone\Tools;

/**
 * Create a gateway chat completion.
 */
class HeliconeGatewayChatCompletions extends AbstractHeliconeTool
{
    protected const NAME = 'helicone_gateway_chat_completions';
    protected const DESCRIPTION = 'Create an OpenAI-compatible chat completion through Helicone AI Gateway. Body must match /v1/chat/completions.';
    protected const SERVICE_METHOD = 'gatewayChatCompletions';
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'OpenAI-compatible chat completion body.'],
    ];
}
