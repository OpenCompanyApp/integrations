<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\Integrations\Vero\VeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VeroRemoveTag implements Tool
{
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_remove_tag';
    }

    public function description(): string
    {
        return 'Remove one or more tags from a user in Vero. The user must already be identified and have the specified tags assigned.';
    }

    public function parameters(): array
    {
        return [
            'identity' => ['type' => 'string', 'required' => true, 'description' => 'Unique user identifier — the same ID or email used when identifying the user.'],
            'tags' => ['type' => 'array', 'required' => true, 'description' => 'Array of tag names to remove (e.g., ["Trial", "Inactive"]).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $identity = $args['identity'];
            $tags = $args['tags'];

            if (is_string($tags)) {
                $tags = json_decode($tags, true) ?? [];
            }

            if (empty($tags) || !is_array($tags)) {
                return ToolResult::error('The tags parameter must be a non-empty array of tag names.');
            }

            $result = $this->service->removeTag($identity, $tags);

            return ToolResult::success([
                'message' => sprintf("Tags %s removed from user '%s'.", json_encode($tags), $identity),
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
