<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details for a single Netlify form.
 *
 * Returns full form details including fields, submission count, and created/updated timestamps.
 */
class NetlifyGetForm implements Tool
{
    /**
     * Create a new NetlifyGetForm tool instance.
     */
    public function __construct(
        private NetlifyService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'netlify_get_form';
    }

    /**
     * Get the tool description shown to AI agents.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Netlify form, including fields, submission count, and timestamps.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The Netlify form ID.'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Netlify integration is not configured.');
            }

            $result = $this->service->getForm($args['form_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
