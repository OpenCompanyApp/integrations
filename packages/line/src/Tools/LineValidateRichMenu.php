<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Validate a LINE rich menu object.
 *
 * Calls the LINE rich menu validation endpoint before creation.
 */
class LineValidateRichMenu implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_validate_rich_menu';
    }

    public function description(): string
    {
        return 'Validate a LINE rich menu object.';
    }

    public function parameters(): array
    {
        return ['rich_menu' => ['type' => 'object', 'required' => true, 'description' => 'LINE rich menu object without richMenuId.']];
    }

    /**
     * Validate rich menu metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->validateRichMenu($args['rich_menu'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
