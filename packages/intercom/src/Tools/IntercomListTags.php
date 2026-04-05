<?php

namespace OpenCompany\Integrations\Intercom\Tools;

use OpenCompany\Integrations\Intercom\IntercomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Intercom tags.
 *
 * Returns all tags in the Intercom workspace with their IDs and names.
 */
class IntercomListTags implements Tool
{
    /**
     * @param  IntercomService  $service  The Intercom API client
     */
    public function __construct(
        private IntercomService $service,
    ) {}

    public function name(): string
    {
        return 'intercom_list_tags';
    }

    public function description(): string
    {
        return <<<'MD'
        List all tags in the Intercom workspace.
        Returns tag IDs, names, and types.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all Intercom tags.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Intercom integration is not configured.');
            }

            $result = $this->service->listTags();

            $tags = array_map(function (array $tag): array {
                return [
                    'id' => $tag['id'] ?? '',
                    'name' => $tag['name'] ?? '',
                    'type' => $tag['type'] ?? '',
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'results' => $tags,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
