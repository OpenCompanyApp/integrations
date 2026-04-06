<?php

namespace OpenCompany\Integrations\Moosend\Tools;

use OpenCompany\Integrations\Moosend\MoosendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MoosendCreateMailingList implements Tool
{
    /**
     * Create a new MoosendCreateMailingList tool instance.
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
        return 'moosend_create_mailing_list';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Create a new mailing list in Moosend. Returns the newly created list with its ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new mailing list.'],
        ];
    }

    /**
     * Execute the tool: create a new mailing list in Moosend.
     *
     * @param array $args The tool arguments (name).
     * @return ToolResult The result containing the created mailing list or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Moosend integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('The "name" parameter is required.');
            }

            $result = $this->service->createMailingList($args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
