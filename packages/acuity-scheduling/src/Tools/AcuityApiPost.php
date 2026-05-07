<?php

namespace OpenCompany\Integrations\AcuityScheduling\Tools;

/**
 * Call any Acuity Scheduling POST API endpoint.
 */
class AcuityApiPost extends AbstractAcuityTool
{
    public function name(): string
    {
        return 'acuity_api_post';
    }

    public function description(): string
    {
        return 'Call any Acuity Scheduling API v1 POST endpoint.';
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
        return $this->service->apiPost($this->stringArg($args, 'path'), is_array($args['body'] ?? null) ? $args['body'] : []);
    }
}
