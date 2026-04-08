<?php

namespace OpenCompany\Integrations\Mautic\Tools;

use OpenCompany\Integrations\Mautic\MauticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MauticListEmails — List marketing emails from Mautic.
 *
 * Calls GET /api/emails and returns paginated email results.
 *
 * @see https://developer.mautic.org/#get-email-list
 */
class MauticListEmails implements Tool
{
    /**
     * @param  MauticService  $service  The Mautic API service instance.
     */
    public function __construct(
        private MauticService $service,
    ) {}

    /**
     * The tool identifier used in the registry.
     */
    public function name(): string
    {
        return 'mautic_list_emails';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List marketing emails from Mautic. Returns email details including name, subject, and publish status.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'search' => ['type' => 'string', 'description' => 'Search query to filter emails.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of emails to return (default: 30).'],
            'start' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'orderBy' => ['type' => 'string', 'description' => 'Field to order by (e.g. "subject", "id").'],
            'orderByDir' => ['type' => 'string', 'description' => 'Order direction: "asc" or "desc".'],
        ];
    }

    /**
     * Execute the tool — list emails from Mautic.
     *
     * @param  array<string, mixed>  $args  Tool arguments (search, limit, start, orderBy, orderByDir).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mautic integration is not configured.');
            }

            $params = [];
            if (isset($args['search'])) {
                $params['search'] = $args['search'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['start'])) {
                $params['start'] = (int) $args['start'];
            }
            if (isset($args['orderBy'])) {
                $params['orderBy'] = $args['orderBy'];
            }
            if (isset($args['orderByDir'])) {
                $params['orderByDir'] = $args['orderByDir'];
            }

            $result = $this->service->listEmails($params);

            $emails = $result['emails'] ?? [];
            $total = $result['total'] ?? count($emails);

            return ToolResult::success([
                'emails' => $emails,
                'total' => $total,
                'count' => count($emails),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
