<?php

namespace OpenCompany\Integrations\Recaptcha\Tools;

use OpenCompany\Integrations\Recaptcha\RecaptchaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ListKeys implements Tool
{
    public function __construct(
        private RecaptchaService $service,
    ) {}

    public function name(): string
    {
        return 'recaptcha_list_keys';
    }

    public function description(): string
    {
        return 'List reCAPTCHA Enterprise site keys for a Google Cloud project. Returns key names, display names, web settings, and integration type. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'required' => true, 'description' => 'The project resource name, e.g. "projects/my-project".'],
            'page_size' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of keys to return per page (default: 50, max: 100).', 'default' => 50],
            'page_token' => ['type' => 'string', 'required' => false, 'description' => 'Page token from a previous list response to fetch the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $parent = $args['parent'] ?? null;
            if (!$parent) {
                return ToolResult::error('parent is required. Provide the project resource name, e.g. "projects/my-project".');
            }

            $pageSize = min(max((int) ($args['page_size'] ?? 50), 1), 100);
            $pageToken = $args['page_token'] ?? '';

            $result = $this->service->listKeys($parent, $pageSize, $pageToken);

            $keys = array_map(function (array $key): array {
                return $this->formatKey($key);
            }, $result['keys'] ?? []);

            return ToolResult::success([
                'keys' => $keys,
                'next_page_token' => $result['nextPageToken'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    private function formatKey(array $key): array
    {
        return [
            'name' => $key['name'] ?? null,
            'display_name' => $key['displayName'] ?? null,
            'web_settings' => $key['webSettings'] ?? [],
            'android_settings' => $key['androidSettings'] ?? [],
            'ios_settings' => $key['iosSettings'] ?? [],
            'labels' => $key['labels'] ?? [],
            'create_time' => $key['createTime'] ?? null,
        ];
    }
}
