<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Call Braintrust AI proxy completions.
 */
class BraintrustProxyCompletions extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_proxy_completions';
    protected const DESCRIPTION = 'Create an OpenAI-compatible text completion through the Braintrust AI proxy.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/proxy/completions';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'OpenAI-compatible completion body.']];
}
