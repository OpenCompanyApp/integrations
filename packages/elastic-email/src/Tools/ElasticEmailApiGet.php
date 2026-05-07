<?php

namespace OpenCompany\Integrations\ElasticEmail\Tools;

/**
 * Call a read-only Elastic Email API v4 endpoint.
 */
class ElasticEmailApiGet extends AbstractElasticEmailTool
{
    public function name(): string
    {
        return 'elasticemail_api_get';
    }

    public function description(): string
    {
        return 'Call any Elastic Email API v4 GET endpoint not covered by a first-class tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path such as /domains or /security/apikeys.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->apiGet($this->stringArg($args, 'path'), $this->params($args));
    }
}
