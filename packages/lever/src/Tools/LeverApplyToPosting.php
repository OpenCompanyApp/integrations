<?php

namespace OpenCompany\Integrations\Lever\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Lever\LeverService;

/**
 * Submit an application to a Lever job posting.
 *
 * Sends the JSON application shape accepted by Lever's official Postings API.
 */
class LeverApplyToPosting implements Tool
{
    /**
     * @param  LeverService  $service  Lever Postings API client.
     */
    public function __construct(private LeverService $service) {}

    public function name(): string
    {
        return 'lever_apply_to_posting';
    }

    public function description(): string
    {
        return 'Submit a candidate application to a Lever posting.

Official Lever endpoint: POST /v0/postings/{site}/{posting_id}?key={api_key}
Requires a Lever Postings API key. The JSON body must include name and email, and may include phone, org, urls, comments, silent, source, ip, timezone, userAgent, acceptLanguage, referer, consent, and opportunityLocation.';
    }

    public function parameters(): array
    {
        return [
            'site' => ['type' => 'string', 'required' => true, 'description' => 'Lever site slug, usually the company name from jobs.lever.co/{site}.'],
            'posting_id' => ['type' => 'string', 'required' => true, 'description' => 'Lever posting ID.'],
            'body' => [
                'type' => 'object',
                'required' => true,
                'description' => 'Lever JSON application body. Required fields are name and email; account-specific forms may require more fields.',
                'properties' => [
                    'name' => ['type' => 'string', 'description' => 'Candidate name.'],
                    'email' => ['type' => 'string', 'description' => 'Candidate email address.'],
                    'phone' => ['type' => 'string', 'description' => 'Candidate phone number.'],
                    'org' => ['type' => 'string', 'description' => 'Current company or organization.'],
                    'urls' => ['type' => 'object', 'description' => 'Candidate URLs keyed by label, such as GitHub or LinkedIn.'],
                    'comments' => ['type' => 'string', 'description' => 'Additional applicant comments.'],
                    'silent' => ['type' => 'boolean', 'description' => 'Disable confirmation email when true.'],
                    'source' => ['type' => 'string', 'description' => 'Source tag to add to the candidate.'],
                    'consent' => ['type' => 'object', 'description' => 'Lever consent fields such as marketing and store.'],
                ],
            ],
        ];
    }

    /**
     * Execute the Lever application submission request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $body = $args['body'] ?? null;
            if (!is_array($body) || $body === []) {
                throw new InvalidArgumentException('body must be a non-empty Lever application object.');
            }

            foreach (['name', 'email'] as $required) {
                if (!isset($body[$required]) || !is_string($body[$required]) || trim($body[$required]) === '') {
                    throw new InvalidArgumentException('body.'.$required.' must be a non-empty string.');
                }
            }

            return ToolResult::success($this->service->applyToPosting(
                $this->requireString($args, 'site'),
                $this->requireString($args, 'posting_id'),
                $body,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Require a non-empty string argument.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireString(array $args, string $key): string
    {
        $value = $args[$key] ?? null;
        if (!is_string($value) || trim($value) === '') {
            throw new InvalidArgumentException($key.' must be a non-empty string.');
        }

        return $value;
    }
}
