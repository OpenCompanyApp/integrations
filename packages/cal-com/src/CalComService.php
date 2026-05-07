<?php

namespace OpenCompany\Integrations\CalCom;

use OpenCompany\Integrations\Cal\CalService;

/**
 * Legacy compatibility service for the old cal-com package namespace.
 *
 * Delegates core Cal.com API v2 behavior to the canonical CalService so the
 * duplicate package does not drift away from the maintained integration.
 */
class CalComService extends CalService
{
    /**
     * @param  string  $accessToken  Cal.com API key, managed-user token, or OAuth access token.
     * @param  string  $baseUrl  Cal.com API base URL.
     */
    public function __construct(
        string $accessToken = '',
        string $baseUrl = 'https://api.cal.com/v2',
    ) {
        parent::__construct($accessToken, $baseUrl);
    }

    /**
     * List teams visible to the authenticated Cal.com token.
     *
     * @param  int|null  $limit  Optional legacy maximum result count.
     * @param  int|null  $page  Optional legacy page number.
     * @return array<string, mixed>
     */
    public function listTeams(?int $limit = null, ?int $page = null): array
    {
        $params = [];

        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->apiGet('/teams', $params);
    }
}
