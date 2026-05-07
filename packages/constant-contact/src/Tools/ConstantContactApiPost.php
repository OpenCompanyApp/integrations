<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Call a Constant Contact API v3 POST endpoint.
 */
class ConstantContactApiPost extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_api_post';
    }

    public function description(): string
    {
        return 'Call a Constant Contact API v3 POST endpoint with a JSON payload.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path such as /activities/contact_exports.'],
            'payload' => ['type' => 'object', 'description' => 'JSON request body.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->apiPost($this->stringArg($args, 'path'), $this->params($args, 'payload'));
    }
}
