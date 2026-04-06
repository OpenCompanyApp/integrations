<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

use OpenCompany\Integrations\EdenAi\EdenAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Perform OCR (Optical Character Recognition) using AI models through Eden AI.
 *
 * Sends an asynchronous OCR request to one or more AI providers via the
 * Eden AI aggregation API. Extracts text from images, PDFs, and documents.
 * Note: This endpoint is asynchronous — the response may contain a job ID
 * for polling the result.
 */
class EdenAiOcr implements Tool
{
    public function __construct(
        private EdenAiService $service,
    ) {}

    public function name(): string
    {
        return 'edenai_ocr';
    }

    public function description(): string
    {
        return 'Extract text from images and documents using OCR via Eden AI. Supports providers like Google Cloud Vision, Amazon Textract, Microsoft Azure, and more. This is an async operation — the response may contain a public_job_id for tracking. Provide the document as a URL or base64-encoded string.';
    }

    public function parameters(): array
    {
        return [
            'providers' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list of OCR providers (e.g., "google", "amazon", "microsoft").'],
            'document_url' => ['type' => 'string', 'description' => 'URL of the image or document to process. Use this OR document_base64, not both.'],
            'document_base64' => ['type' => 'string', 'description' => 'Base64-encoded document data. Use this OR document_url, not both.'],
            'language' => ['type' => 'string', 'description' => 'Language hint for OCR (e.g., "en", "fr", "de"). Improves accuracy for specific languages.'],
            'fallback_providers' => ['type' => 'string', 'description' => 'Comma-separated list of fallback providers if the primary fails.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Eden AI integration is not configured.');
            }

            $body = [
                'providers' => $args['providers'],
            ];

            if (isset($args['document_url'])) {
                $body['file_url'] = $args['document_url'];
            } elseif (isset($args['document_base64'])) {
                $body['base64_file'] = $args['document_base64'];
            } else {
                return ToolResult::error('Either "document_url" or "document_base64" is required.');
            }

            if (isset($args['language'])) {
                $body['language'] = $args['language'];
            }

            if (isset($args['fallback_providers'])) {
                $body['fallback_providers'] = $args['fallback_providers'];
            }

            $result = $this->service->ocr($body);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the OCR response.
     *
     * @param  array<string, mixed>  $result  Raw API response.
     * @return array<string, mixed> Formatted response with OCR results or job info.
     */
    private function formatResponse(array $result): array
    {
        // Async response — return job ID for polling
        if (isset($result['public_job_id'])) {
            return [
                'jobId' => $result['public_job_id'],
                'status' => $result['status'] ?? 'pending',
                'message' => 'OCR request submitted. Use the job ID to poll for results.',
            ];
        }

        // Direct response with provider results
        $response = [];

        foreach ($result as $providerKey => $providerResult) {
            if (!is_array($providerResult)) {
                continue;
            }

            $entry = [
                'provider' => $providerKey,
            ];

            if (isset($providerResult['text'])) {
                $entry['text'] = $providerResult['text'];
            }

            if (isset($providerResult['status'])) {
                $entry['status'] = $providerResult['status'];
            }

            if (isset($providerResult['cost'])) {
                $entry['cost'] = $providerResult['cost'];
            }

            if (isset($providerResult['error'])) {
                $entry['error'] = $providerResult['error'];
            }

            $response[] = $entry;
        }

        return [
            'results' => $response,
            'providerCount' => count($response),
        ];
    }
}
