<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Call an Elastic Email API v4 POST endpoint.
 */
class ElasticEmailApiPost extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_api_post';
    }

    public function description(): string
    {
        return 'Call an Elastic Email API v4 POST endpoint with a JSON payload.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path such as /contacts/export.'],
            'payload' => ['type' => 'object', 'description' => 'JSON request payload.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->apiPost($this->stringArg($args, 'path'), $this->params($args, 'payload'));
    }
}
