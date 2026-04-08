<?php

namespace OpenCompany\Integrations\Box\Tools;

use OpenCompany\Integrations\Box\BoxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BoxShareFile implements Tool
{
    /**
     * Create a new BoxShareFile tool instance.
     */
    public function __construct(
        private BoxService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'box_share_file';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a shared link for a Box file. By default creates an open link. Optionally configure access level, password protection, and expiration.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'file_id' => ['type' => 'string', 'required' => true, 'description' => 'The Box file ID to share.'],
            'access' => ['type' => 'string', 'description' => 'Access level: "open" (anyone with link), "company" (enterprise users), "collaborators" (invited only). Default: "open".'],
            'password' => ['type' => 'string', 'description' => 'Optional password to protect the shared link.'],
            'expires_at' => ['type' => 'string', 'description' => 'Optional expiration timestamp (ISO 8601, e.g., "2026-12-31T23:59:59Z").'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Box integration is not configured.');
            }

            $fileId = $args['file_id'];
            $settings = [];

            if (isset($args['access'])) {
                $settings['access'] = $args['access'];
            }
            if (isset($args['password'])) {
                $settings['password'] = $args['password'];
            }
            if (isset($args['expires_at'])) {
                $settings['unshared_at'] = $args['expires_at'];
            }

            $result = $this->service->shareFile($fileId, $settings);

            $sharedLink = $result['shared_link'] ?? [];

            return ToolResult::success([
                'file_id' => $fileId,
                'shared_link' => $sharedLink['url'] ?? null,
                'access' => $sharedLink['access'] ?? null,
                'download_url' => $sharedLink['download_url'] ?? null,
                'message' => isset($sharedLink['url'])
                    ? "Shared link created: {$sharedLink['url']}"
                    : 'Shared link created.',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
