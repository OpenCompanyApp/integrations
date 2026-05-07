<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Call the Braintrust AI proxy auto endpoint.
 */
class BraintrustProxyAuto extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_proxy_auto';
    protected const DESCRIPTION = 'Call the Braintrust proxy auto endpoint for provider-routed generation.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/proxy/auto';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Proxy auto body matching Braintrust provider-routing schema.']];
}
