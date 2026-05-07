<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Call any Acuity Scheduling DELETE API endpoint.
 */
class AcuityApiDelete extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_api_delete';
    }

    public function description(): string
    {
        return 'Call any Acuity Scheduling API v1 DELETE endpoint.';
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
        return $this->service->apiDelete($this->stringArg($args, 'path'), is_array($args['body'] ?? null) ? $args['body'] : []);
    }
}
