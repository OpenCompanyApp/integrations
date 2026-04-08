<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single post from a Beehiiv publication by ID.
 */
class BeehiivGetPost implements Tool
{
    /**
     * Create a new BeehiivGetPost tool instance.
     */
    public function __construct(
        private BeehiivService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'beehiiv_get_post';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get a single post from your Beehiiv publication by its post ID.';
    }

    /**
     * Get the tool parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'post_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the post to retrieve.'],
        ];
    }

    /**
     * Execute the tool — get a post from Beehiiv.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beehiiv integration is not configured. Provide an API key and publication ID.');
            }

            $result = $this->service->getPost($args['post_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
