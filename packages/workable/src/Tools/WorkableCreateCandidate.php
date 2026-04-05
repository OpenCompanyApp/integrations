<?php

namespace OpenCompany\Integrations\Workable\Tools;

use OpenCompany\Integrations\Workable\WorkableService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new candidate for a specific Workable job.
 *
 * Adds a candidate to a job's pipeline with their name and email.
 * Optionally includes phone, headline, address, and cover letter.
 */
class WorkableCreateCandidate implements Tool
{
    /**
     * Create a new WorkableCreateCandidate tool instance.
     */
    public function __construct(
        private WorkableService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'workable_create_candidate';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new candidate for a specific job in Workable. Provide the job shortcode, candidate name, and email address.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'shortcode' => ['type' => 'string', 'required' => true, 'description' => 'The job shortcode to add the candidate to (e.g., "GRO-001").'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The candidate\'s full name.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The candidate\'s email address.'],
            'phone' => ['type' => 'string', 'description' => 'The candidate\'s phone number.'],
            'headline' => ['type' => 'string', 'description' => 'A brief headline or title for the candidate.'],
            'cover_letter' => ['type' => 'string', 'description' => 'The candidate\'s cover letter text.'],
        ];
    }

    /**
     * Execute the create candidate request.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Workable integration is not configured.');
            }

            if (empty($args['shortcode'])) {
                return ToolResult::error('The shortcode parameter is required.');
            }
            if (empty($args['name'])) {
                return ToolResult::error('The name parameter is required.');
            }
            if (empty($args['email'])) {
                return ToolResult::error('The email parameter is required.');
            }

            $additional = [];
            if (isset($args['phone'])) {
                $additional['phone'] = $args['phone'];
            }
            if (isset($args['headline'])) {
                $additional['headline'] = $args['headline'];
            }
            if (isset($args['cover_letter'])) {
                $additional['cover_letter'] = $args['cover_letter'];
            }

            $result = $this->service->createCandidate(
                $args['shortcode'],
                $args['name'],
                $args['email'],
                $additional,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
