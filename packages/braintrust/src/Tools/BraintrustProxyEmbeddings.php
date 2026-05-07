<?php

namespace OpenCompany\Integrations\Braintrust\Tools;

/**
 * Call Braintrust AI proxy embeddings.
 */
class BraintrustProxyEmbeddings extends AbstractBraintrustTool
{
    protected const NAME = 'braintrust_proxy_embeddings';
    protected const DESCRIPTION = 'Create embeddings through the Braintrust AI proxy.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/proxy/embeddings';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'OpenAI-compatible embeddings body.']];
}
