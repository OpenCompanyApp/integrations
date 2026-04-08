<?php

namespace OpenCompany\Integrations\Recaptcha\Tools;

use OpenCompany\Integrations\Recaptcha\RecaptchaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ListAssessments implements Tool
{
    public function __construct(
        private RecaptchaService $service,
    ) {}

    public function name(): string
    {
        return 'recaptcha_list_assessments';
    }

    public function description(): string
    {
        return 'List reCAPTCHA Enterprise assessments for a Google Cloud project. Returns assessment names, scores, token properties, and event details. Supports pagination with page size and page token.';
    }

    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'required' => true, 'description' => 'The project resource name, e.g. "projects/my-project".'],
            'page_size' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of assessments to return per page (default: 50, max: 100).', 'default' => 50],
            'page_token' => ['type' => 'string', 'required' => false, 'description' => 'Page token from a previous list response to fetch the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $parent = $args['parent'] ?? null;
            if (!$parent) {
                return ToolResult::error('parent is required. Provide the project resource name, e.g. "projects/my-project".');
            }

            $pageSize = min(max((int) ($args['page_size'] ?? 50), 1), 100);
            $pageToken = $args['page_token'] ?? '';

            $result = $this->service->listAssessments($parent, $pageSize, $pageToken);

            $assessments = array_map(function (array $assessment): array {
                return $this->formatAssessment($assessment);
            }, $result['assessments'] ?? []);

            return ToolResult::success([
                'assessments' => $assessments,
                'next_page_token' => $result['nextPageToken'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    private function formatAssessment(array $assessment): array
    {
        return [
            'name' => $assessment['name'] ?? null,
            'score' => $assessment['score'] ?? null,
            'score_details' => $assessment['scoreDetails'] ?? [],
            'token_properties' => $assessment['tokenProperties'] ?? [],
            'event' => $assessment['event'] ?? [],
            'account_defender_assessment' => $assessment['accountDefenderAssessment'] ?? null,
            'create_time' => $assessment['assessmentReasons'] ?? [],
        ];
    }
}
