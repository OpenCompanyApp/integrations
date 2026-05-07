<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Call Braintrust AI proxy chat completions.
 */
class BraintrustProxyChatCompletions extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_proxy_chat_completions';
    protected const DESCRIPTION = 'Create an OpenAI-compatible chat completion through the Braintrust AI proxy.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/proxy/chat/completions';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'OpenAI-compatible chat completion body.']];
}
