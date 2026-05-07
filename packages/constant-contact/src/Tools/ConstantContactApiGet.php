<?php

namespace OpenCompany\Integrations\ConstantContact\Tools;

/**
 * Call a read-only Constant Contact API v3 endpoint.
 */
class ConstantContactApiGet extends AbstractConstantContactTool
{
    public function name(): string
    {
        return 'constantcontact_api_get';
    }

    public function description(): string
    {
        return 'Call a read-only Constant Contact API v3 endpoint not covered by a first-class tool.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path such as /account/summary or /reports/email_reports/{activity_id}/tracking/opens.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->apiGet($this->stringArg($args, 'path'), $this->params($args));
    }
}
