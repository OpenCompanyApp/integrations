<?php

namespace OpenCompany\Integrations\Recaptcha\Tools;

use OpenCompany\Integrations\Recaptcha\RecaptchaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ListAnnotations implements Tool
{
    public function __construct(
        private RecaptchaService $service,
    ) {}

    public function name(): string
    {
        return 'recaptcha_list_annotations';
    }

    public function description(): string
    {
        return 'List annotations for a reCAPTCHA Enterprise assessment. Annotations provide feedback on assessment results (LEGITIMATE, FRAUDULENT, etc.) to improve model accuracy. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'parent' => ['type' => 'string', 'required' => true, 'description' => 'The assessment resource name, e.g. "projects/my-project/assessments/12345678".'],
            'page_size' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of annotations to return per page (default: 50, max: 100).', 'default' => 50],
            'page_token' => ['type' => 'string', 'required' => false, 'description' => 'Page token from a previous list response to fetch the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            $parent = $args['parent'] ?? null;
            if (!$parent) {
                return ToolResult::error('parent is required. Provide the assessment resource name, e.g. "projects/my-project/assessments/12345678".');
            }

            $pageSize = min(max((int) ($args['page_size'] ?? 50), 1), 100);
            $pageToken = $args['page_token'] ?? '';

            $result = $this->service->listAnnotations($parent, $pageSize, $pageToken);

            $annotations = array_map(function (array $annotation): array {
                return $this->formatAnnotation($annotation);
            }, $result['annotations'] ?? []);

            return ToolResult::success([
                'annotations' => $annotations,
                'next_page_token' => $result['nextPageToken'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    private function formatAnnotation(array $annotation): array
    {
        return [
            'name' => $annotation['name'] ?? null,
            'annotation_id' => $annotation['annotationId'] ?? null,
            'create_time' => $annotation['createTime'] ?? null,
            'reason' => $annotation['reason'] ?? null,
        ];
    }
}
