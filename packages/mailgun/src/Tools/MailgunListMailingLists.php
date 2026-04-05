<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all mailing lists in the Mailgun account.
 *
 * Supports pagination via limit and page parameters.
 */
class MailgunListMailingLists implements Tool
{
    /**
     * @param  MailgunService  $service  The Mailgun API client
     */
    public function __construct(
        private MailgunService $service,
    ) {}

    public function name(): string
    {
        return 'mailgun_list_mailing_lists';
    }

    public function description(): string
    {
        return 'List all mailing lists in the Mailgun account. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of lists to return (default 100).'],
            'page'  => ['type' => 'string', 'description' => 'Page URL or token for pagination.'],
        ];
    }

    /**
     * List all mailing lists in the Mailgun account.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mailgun integration is not configured.');
            }

            $params = [];

            if (! empty($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (! empty($args['page'])) {
                $params['page'] = $args['page'];
            }

            $result = $this->service->listMailingLists($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
