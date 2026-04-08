<?php

namespace OpenCompany\Integrations\Dropbox\Tools;

use OpenCompany\Integrations\Dropbox\DropboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a shared link for a file or folder in Dropbox.
 */
class DropboxCreateSharedLink implements Tool
{
    /** @param  DropboxService  $service  The Dropbox API client */
    public function __construct(
        private DropboxService $service,
    ) {}

    public function name(): string
    {
        return 'dropbox_create_shared_link';
    }

    public function description(): string
    {
        return 'Create a shared link for a file or folder in Dropbox. Optionally configure link settings such as access level, password, and expiry.';
    }

    public function parameters(): array
    {
        return [
            'path' => ['type' => 'string', 'required' => true, 'description' => 'Path to the file or folder to share, e.g. "/Photos/vacation.jpg".'],
            'settings' => ['type' => 'object', 'description' => 'Link settings object. Keys: requested_visibility ("public", "team_only", "password"), link_password, expires (timestamp), audience, access.'],
        ];
    }

    /**
     * Create a shared link for a file or folder.
     *
     * @param  array<string, mixed>  $args  Tool arguments (path, settings)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Dropbox is not configured. Missing access token.');
        }

        $path = $args['path'] ?? '';

        if (empty($path)) {
            return ToolResult::error('A path is required.');
        }

        try {
            $params = ['path' => $path];

            if (isset($args['settings'])) {
                $params['settings'] = $args['settings'];
            }

            $result = $this->service->createSharedLink($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
