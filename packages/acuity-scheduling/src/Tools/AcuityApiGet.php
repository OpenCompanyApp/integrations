<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Call any Acuity Scheduling GET API endpoint.
 */
class AcuityApiGet extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_api_get';
    }

    public function description(): string
    {
        return 'Call any Acuity Scheduling API v1 GET endpoint.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path such as /forms or /orders.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->apiGet($this->stringArg($args, 'path'), is_array($args['params'] ?? null) ? $args['params'] : []);
    }
}
