<?php

namespace OpenCompany\Integrations\Moosend\Tools;

use OpenCompany\Integrations\Moosend\MoosendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MoosendGetMailingList implements Tool
{
    /**
     * Create a new MoosendGetMailingList tool instance.
     *
     * @param MoosendService $service The Moosend service instance.
     */
    public function __construct(
        private MoosendService $service,
    ) {}

    /**
     * Get the tool name identifier.
     *
     * @return string
     */
    public function name(): string
    {
        return 'moosend_get_mailing_list';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Get detailed information about a specific mailing list in Moosend, including subscriber counts and settings.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The mailing list ID.'],
        ];
    }

    /**
     * Execute the tool: get details for a specific mailing list.
     *
     * @param array $args The tool arguments (id).
     * @return ToolResult The result containing mailing list details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Moosend integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getMailingList($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
