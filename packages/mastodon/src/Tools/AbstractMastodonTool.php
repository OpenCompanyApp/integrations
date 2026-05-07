<?php

namespace OpenCompany\Integrations\Mastodon\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Mastodon\MastodonService;

/**
 * Base class for generic Mastodon API tools.
 */
abstract class AbstractMastodonTool implements Tool
{
    /**
     * @param  MastodonService  $service  Mastodon API client.
     */
    public function __construct(protected MastodonService $service) {}

    /**
     * Execute the Mastodon tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mastodon integration is not configured.');
            }

            return ToolResult::success($this->callService($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Call the concrete service method for this tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    abstract protected function callService(array $args): array;

    /**
     * Return a required API path.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function path(array $args): string
    {
        if (empty($args['path'])) {
            throw new \RuntimeException('path is required.');
        }

        return (string) $args['path'];
    }
}
