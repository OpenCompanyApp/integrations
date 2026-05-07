<?php

namespace OpenCompany\Integrations\Mindee\Tools;

use RuntimeException;

/**
 * Poll a Mindee asynchronous prediction job.
 */
class MindeeGetAsyncPrediction extends AbstractMindeeTool
{
    public function name(): string
    {
        return 'mindee_get_async_prediction';
    }

    public function description(): string
    {
        return 'Retrieve a Mindee asynchronous prediction job status, or the completed document redirect when the job has finished.';
    }

    public function parameters(): array
    {
        return [
            'account' => ['type' => 'string', 'required' => true, 'description' => 'Mindee account name.'],
            'api_name' => ['type' => 'string', 'required' => true, 'description' => 'Mindee API name.'],
            'api_version' => ['type' => 'string', 'required' => true, 'description' => 'Mindee API version.'],
            'job_id' => ['type' => 'string', 'required' => true, 'description' => 'Mindee asynchronous job ID.'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        foreach (['account', 'api_name', 'api_version', 'job_id'] as $key) {
            if (empty($args[$key])) {
                throw new RuntimeException("{$key} is required.");
            }
        }

        return $this->service->getAsyncPrediction(
            (string) $args['account'],
            (string) $args['api_name'],
            (string) $args['api_version'],
            (string) $args['job_id'],
        );
    }
}
