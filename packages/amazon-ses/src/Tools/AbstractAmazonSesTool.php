<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AmazonSes\AmazonSesService;

/**
 * Base class for Amazon SES tools that delegate directly to AmazonSesService.
 */
abstract class AbstractAmazonSesTool implements Tool
{
    /**
     * @param  AmazonSesService  $service  Signed Amazon SES API client.
     */
    public function __construct(protected AmazonSesService $service) {}

    /**
     * Execute the Amazon SES tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Amazon SES integration is not configured.');
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
     * Return a required string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    protected function stringArg(array $args, string $key): string
    {
        if (empty($args[$key])) {
            throw new \RuntimeException("{$key} is required.");
        }

        return (string) $args[$key];
    }
}
