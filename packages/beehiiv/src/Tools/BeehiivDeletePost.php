<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to delete a post from a Beehiiv publication.
 */
class BeehiivDeletePost implements Tool
{
    /**
     * Create a new BeehiivDeletePost tool instance.
     */
    public function __construct(
        private BeehiivService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'beehiiv_delete_post';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Delete a post from your Beehiiv publication. This action is irreversible.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'post_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the post to delete.'],
        ];
    }

    /**
     * Execute the tool — delete a post from Beehiiv.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beehiiv integration is not configured. Provide an API key and publication ID.');
            }

            $this->service->deletePost($args['post_id']);

            return ToolResult::success([
                'deleted' => true,
                'post_id' => $args['post_id'],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
