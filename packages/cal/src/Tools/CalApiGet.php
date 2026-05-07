<?php

namespace OpenCompany\Integrations\Cal\Tools;

/**
 * Call any Cal.com GET API endpoint.
 */
class CalApiGet extends AbstractCalTool
{
    public function name(): string
    {
        return 'cal_api_get';
    }

    public function description(): string
    {
        return 'Call any Cal.com v2 GET API endpoint.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path such as /bookings or /slots.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->apiGet(
            $this->stringArg($args, 'path'),
            is_array($args['params'] ?? null) ? $args['params'] : [],
        );
    }
}
