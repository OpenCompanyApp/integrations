<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List outbound messages from Postmark.
 *
 * Supports filtering by recipient, sender, subject, status, tag, and pagination.
 */
class PostmarkListMessages implements Tool
{
    /**
     * @param  PostmarkService  $service  The Postmark API client
     */
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_list_messages';
    }

    public function description(): string
    {
        return 'List outbound messages from Postmark. Supports filtering by recipient, sender, subject, status, and tag.';
    }

    public function parameters(): array
    {
        return [
            'count'      => ['type' => 'integer', 'description' => 'Number of messages to return per page (default 100, max 500).'],
            'offset'     => ['type' => 'integer', 'description' => 'Number of messages to skip for pagination.'],
            'recipient'  => ['type' => 'string', 'description' => 'Filter by recipient email address.'],
            'fromemail'  => ['type' => 'string', 'description' => 'Filter by sender email address.'],
            'subject'    => ['type' => 'string', 'description' => 'Filter by email subject.'],
            'status'     => ['type' => 'string', 'description' => 'Filter by status (queued, sent, bounced, etc.).'],
            'tag'        => ['type' => 'string', 'description' => 'Filter by tag.'],
        ];
    }

    /**
     * List outbound messages from Postmark.
     *
     * @param  array<string, mixed>  $args  Tool arguments (count, offset, recipient, fromemail, subject, status, tag)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $params = [];

            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (! empty($args['recipient'])) {
                $params['recipient'] = $args['recipient'];
            }
            if (! empty($args['fromemail'])) {
                $params['fromemail'] = $args['fromemail'];
            }
            if (! empty($args['subject'])) {
                $params['subject'] = $args['subject'];
            }
            if (! empty($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (! empty($args['tag'])) {
                $params['tag'] = $args['tag'];
            }

            $result = $this->service->listMessages($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
