<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Call any Acuity Scheduling PUT API endpoint.
 */
class AcuityApiPut extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_api_put';
    }

    public function description(): string
    {
        return 'Call any Acuity Scheduling API v1 PUT endpoint.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'API path.'],
            'body' => ['type' => 'object', 'description' => 'JSON body.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->apiPut($this->stringArg($args, 'path'), is_array($args['body'] ?? null) ? $args['body'] : []);
    }
}
