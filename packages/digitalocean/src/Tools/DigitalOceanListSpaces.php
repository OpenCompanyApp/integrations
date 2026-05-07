<?php

namespace OpenCompany\Integrations\DigitalOcean\Tools;

use OpenCompany\Integrations\DigitalOcean\DigitalOceanService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List DigitalOcean Spaces access keys.
 *
 * The bearer-token DigitalOcean API manages Spaces keys. Bucket and object
 * listing require the separate S3-compatible Spaces API.
 */
class DigitalOceanListSpaces implements Tool
{
    /**
     * @param  DigitalOceanService  $service  The DigitalOcean API client.
     */
    public function __construct(
        private DigitalOceanService $service,
    ) {}

    public function name(): string
    {
        return 'digitalocean_list_spaces';
    }

    public function description(): string
    {
        return 'List DigitalOcean Spaces access keys. Bucket/object listing uses the separate S3-compatible Spaces API, not this bearer-token API.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of items per page (default: 20).'],
            'sort' => ['type' => 'string', 'description' => 'Sort field supported by the DigitalOcean Spaces Keys API.'],
            'sort_direction' => ['type' => 'string', 'description' => 'Sort direction.', 'enum' => ['asc', 'desc']],
            'name' => ['type' => 'string', 'description' => 'Filter keys by name.'],
            'bucket' => ['type' => 'string', 'description' => 'Filter keys by bucket name.'],
            'permission' => ['type' => 'string', 'description' => 'Filter keys by permission.'],
        ];
    }

    /**
     * List Spaces access keys with supported DigitalOcean query filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page, sort, sort_direction, name, bucket, permission).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DigitalOcean integration is not configured.');
            }

            $params = [];
            foreach (['page', 'per_page', 'sort', 'sort_direction', 'name', 'bucket', 'permission'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = in_array($key, ['page', 'per_page'], true) ? (int) $args[$key] : $args[$key];
                }
            }

            $result = $this->service->listSpaces($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
