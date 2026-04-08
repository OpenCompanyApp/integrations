<?php

namespace OpenCompany\Integrations\PayloadCms\Tools;

use OpenCompany\Integrations\PayloadCms\PayloadCmsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List users in the Payload CMS instance.
 */
class ListUsers implements Tool
{
    /**
     * @param  PayloadCmsService  $service  The Payload CMS API client
     */
    public function __construct(
        private PayloadCmsService $service,
    ) {}

    public function name(): string
    {
        return 'payload_cms_list_users';
    }

    public function description(): string
    {
        return <<<'MD'
        List users in the Payload CMS instance. Supports pagination with limit and page parameters.
        Returns user IDs, emails, names, and roles.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (default 10).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default 1).'],
        ];
    }

    /**
     * List users with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Payload CMS integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listUsers($params);
            $docs = $result['docs'] ?? $result;

            if (empty($docs)) {
                return ToolResult::success('No users found.');
            }

            $output = [];
            foreach ($docs as $user) {
                $output[] = [
                    'id' => $user['id'] ?? '',
                    'email' => $user['email'] ?? '',
                    'name' => $user['name'] ?? ($user['firstName'] ?? '') . ' ' . ($user['lastName'] ?? ''),
                    'roles' => $user['roles'] ?? [],
                    'created_at' => $user['createdAt'] ?? null,
                ];
            }

            return ToolResult::success([
                'total' => $result['totalDocs'] ?? count($output),
                'count' => count($output),
                'page' => $result['page'] ?? 1,
                'totalPages' => $result['totalPages'] ?? 1,
                'items' => $output,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
