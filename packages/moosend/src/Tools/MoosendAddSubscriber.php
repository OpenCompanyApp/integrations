<?php

namespace OpenCompany\Integrations\Moosend\Tools;

use OpenCompany\Integrations\Moosend\MoosendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MoosendAddSubscriber implements Tool
{
    /**
     * Create a new MoosendAddSubscriber tool instance.
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
        return 'moosend_add_subscriber';
    }

    /**
     * Get the tool description.
     *
     * @return string
     */
    public function description(): string
    {
        return 'Add a new subscriber to a Moosend mailing list. Requires an email address; name is optional.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array
     */
    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The mailing list ID to add the subscriber to.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber\'s email address.'],
            'name' => ['type' => 'string', 'description' => 'The subscriber\'s name (optional).'],
        ];
    }

    /**
     * Execute the tool: add a subscriber to a Moosend mailing list.
     *
     * @param array $args The tool arguments (list_id, email, name).
     * @return ToolResult The result containing the added subscriber or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Moosend integration is not configured.');
            }

            if (empty($args['list_id'])) {
                return ToolResult::error('The "list_id" parameter is required.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('The "email" parameter is required.');
            }

            $name = $args['name'] ?? '';

            $result = $this->service->addSubscriber($args['list_id'], $args['email'], $name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
