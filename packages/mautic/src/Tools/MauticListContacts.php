<?php

namespace OpenCompany\Integrations\Mautic\Tools;

use OpenCompany\Integrations\Mautic\MauticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MauticListContacts — List contacts in Mautic with optional search and filters.
 *
 * Calls GET /api/contacts and returns paginated contact results.
 *
 * @see https://developer.mautic.org/#get-contact-list
 */
class MauticListContacts implements Tool
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
        return 'mautic_list_contacts';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List contacts in Mautic. Supports search, filtering, pagination, and ordering. Returns contact details including email, name, and custom fields.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'search' => ['type' => 'string', 'description' => 'Search query to filter contacts (e.g. "email:john@example.com" or a name).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: 30, max: 100).'],
            'start' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'orderBy' => ['type' => 'string', 'description' => 'Field to order by (e.g. "email", "firstName", "lastName", "id").'],
            'orderByDir' => ['type' => 'string', 'description' => 'Order direction: "asc" or "desc" (default: "asc").'],
        ];
    }

    /**
     * Execute the tool — list contacts from Mautic.
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

            $result = $this->service->listContacts($params);

            $contacts = $result['contacts'] ?? [];
            $total = $result['total'] ?? count($contacts);

            return ToolResult::success([
                'contacts' => $contacts,
                'total' => $total,
                'count' => count($contacts),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
