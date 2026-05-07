<?php

namespace OpenCompany\Integrations\Cal\Tools;

/**
 * Call any Cal.com POST API endpoint.
 */
class CalApiPost extends AbstractCalTool
{
    public function name(): string
    {
        return 'cal_api_post';
    }

    public function description(): string
    {
        return 'Call any Cal.com v2 POST API endpoint.';
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
        return $this->service->apiPost(
            $this->stringArg($args, 'path'),
            is_array($args['body'] ?? null) ? $args['body'] : [],
        );
    }
}
