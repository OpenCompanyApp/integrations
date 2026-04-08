<?php

namespace OpenCompany\Integrations\Crowdin\Tools;

use OpenCompany\Integrations\Crowdin\CrowdinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific source string from the Crowdin API.
 *
 * Returns string text, context, file associations, and metadata.
 */
class CrowdinGetString implements Tool
{
    public function __construct(
        private CrowdinService $service,
    ) {}

    public function name(): string
    {
        return 'crowdin_get_string';
    }

    public function description(): string
    {
        return 'Get details of a specific source string in a Crowdin project. Returns string text, context, file path, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
            'string_id' => ['type' => 'integer', 'required' => true, 'description' => 'The string ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Crowdin integration is not configured.');
            }

            $projectId = $args['project_id'];
            $stringId = $args['string_id'];
            $result = $this->service->getString($projectId, $stringId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
