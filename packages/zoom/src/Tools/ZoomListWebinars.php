<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List webinars for a Zoom user.
 *
 * Retrieves all webinars for the specified user with pagination support.
 */
class ZoomListWebinars implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_list_webinars';
    }

    public function description(): string
    {
        return 'List webinars for a Zoom user.';
    }

    public function parameters(): array
    {
        return [
            'user_id'   => ['type' => 'string', 'required' => true, 'description' => 'User ID or email address.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of records returned per page (default 30, max 300).'],
        ];
    }

    /**
     * List webinars for a user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_id, page_size)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $userId = $args['user_id'] ?? '';
            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }

            $params = [];

            if (isset($args['page_size'])) {
                $params['page_size'] = (int) $args['page_size'];
            }

            $result = $this->service->listWebinars($userId, $params);

            return ToolResult::success([
                'webinars' => $result['webinars'] ?? [],
                'page_count' => $result['page_count'] ?? 0,
                'total_records' => $result['total_records'] ?? 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
