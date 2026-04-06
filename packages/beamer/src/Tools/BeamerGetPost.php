<?php

namespace OpenCompany\Integrations\Beamer\Tools;

use OpenCompany\Integrations\Beamer\BeamerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single Beamer post by its ID.
 *
 * Returns the full post object including title, content, date, category,
 * and any associated metadata.
 */
class BeamerGetPost implements Tool
{
    public function __construct(
        private BeamerService $service,
    ) {}

    public function name(): string
    {
        return 'beamer_get_post';
    }

    public function description(): string
    {
        return 'Retrieve a single Beamer changelog post by its ID. Returns the full post including title, content, date, category, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The post ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Beamer integration is not configured.');
            }

            $result = $this->service->getPost($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
