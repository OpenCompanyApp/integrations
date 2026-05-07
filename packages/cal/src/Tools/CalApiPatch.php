<?php

namespace OpenCompany\Integrations\Cal\Tools;

/**
 * Call any Cal.com PATCH API endpoint.
 */
class CalApiPatch extends AbstractCalTool
{
    public function name(): string
    {
        return 'cal_api_patch';
    }

    public function description(): string
    {
        return 'Call any Cal.com v2 PATCH API endpoint.';
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
        return $this->service->apiPatch(
            $this->stringArg($args, 'path'),
            is_array($args['body'] ?? null) ? $args['body'] : [],
        );
    }
}
