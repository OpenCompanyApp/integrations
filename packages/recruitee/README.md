# Integration: Recruitee

Recruitee ATS integration for the OpenCompany integration ecosystem. It exposes company-scoped Core API coverage for offers, candidates, departments, locations, attachments, and documented REST endpoints.

## Configuration

This package requires a Recruitee personal API token and company ID or company subdomain.

```php
return [
    'recruitee' => [
        'access_token' => env('RECRUITEE_ACCESS_TOKEN'),
        'company_id' => env('RECRUITEE_COMPANY_ID'),
        'url' => env('RECRUITEE_URL', 'https://api.recruitee.com/c/{company_id}'),
    ],
];
```

The service normalizes the older generated placeholder URL (`https://{company}.recruitee.com/api/v2`) to the current Recruitee Core API base.

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `recruitee_list_offers` | read | List company offers |
| `recruitee_get_offer` | read | Get one offer |
| `recruitee_create_offer` | write | Create an offer |
| `recruitee_update_offer` | write | Update an offer |
| `recruitee_delete_offer` | write | Delete an offer |
| `recruitee_list_candidates` | read | List candidates |
| `recruitee_search_candidates` | read | Search candidates with `/search/new/candidates` |
| `recruitee_get_candidate` | read | Get one candidate |
| `recruitee_create_candidate` | write | Create a candidate and optionally assign offers |
| `recruitee_update_candidate` | write | Update a candidate |
| `recruitee_update_candidate_cv` | write | Update a candidate CV payload |
| `recruitee_delete_candidate` | write | Delete a candidate |
| `recruitee_list_candidate_notes` | read | List notes for one candidate |
| `recruitee_list_departments` | read | List departments |
| `recruitee_list_locations` | read | List locations |
| `recruitee_upload_attachment` | write | Upload a remote attachment to a candidate or offer |
| `recruitee_get_current_user` | read | Get current user when the endpoint is available |
| `recruitee_api_get` | read | Call a documented company-scoped GET endpoint |
| `recruitee_api_post` | write | Call a documented company-scoped POST endpoint |
| `recruitee_api_patch` | write | Call a documented company-scoped PATCH endpoint |
| `recruitee_api_delete` | write | Call a documented company-scoped DELETE endpoint |

## Service Usage

```php
use OpenCompany\Integrations\Recruitee\RecruiteeService;

$service = app(RecruiteeService::class);

$offers = $service->listOffers(['status' => 'published']);
$candidate = $service->getCandidate(12345);
$search = $service->searchCandidates(['limit' => 25, 'sort_by' => 'created_at_desc']);
$locations = $service->listLocations(['scope' => 'active', 'view_mode' => 'brief']);
```

Generic helpers accept paths relative to `https://api.recruitee.com/c/{company_id}`:

```php
$service->apiGet('/locations', ['limit' => 10]);
$service->apiPatch('/offers/12345', ['offer' => ['status' => 'published']]);
```

## Notes

- Use fake data in tests and examples. Do not commit real Recruitee tokens, company IDs, candidate names, or workspace data.
- Recruitee documents company ID path parameters as accepting either an integer company ID or a company subdomain.
- Write tools make live changes in Recruitee. Hosts should present approval flows before running them for agents.

## License

MIT
