<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Recruitee;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Recruitee\RecruiteeService;
use OpenCompany\Integrations\Recruitee\RecruiteeToolProvider;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeApiGet;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeCreateCandidate;
use OpenCompany\Integrations\Recruitee\Tools\RecruiteeUpdateOffer;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Recruitee Core API coverage.
 */
final class RecruiteeServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_core_api_endpoints_and_normalizes_base_url(): void
    {
        Http::fake([
            'https://api.recruitee.com/c/company-1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new RecruiteeService('rt_test', 'company-1', 'https://{company}.recruitee.com/api/v2');

        $service->listOffers(['status' => 'published']);
        $service->getOffer(100);
        $service->createOffer(['title' => 'Support Engineer']);
        $service->updateOffer(100, ['title' => 'Senior Support Engineer']);
        $service->deleteOffer(100);
        $service->listCandidates(['limit' => 10]);
        $service->searchCandidates(['sort_by' => 'created_at_desc']);
        $service->getCandidate(200);
        $service->createCandidate(['name' => 'Example Candidate'], [100]);
        $service->updateCandidate(200, ['name' => 'Updated Candidate']);
        $service->updateCandidateCv(200, ['remote_cv_url' => 'https://example.test/cv.pdf']);
        $service->listCandidateNotes(200);
        $service->deleteCandidate(200);
        $service->listDepartments();
        $service->listLocations(['scope' => 'active']);
        $service->uploadAttachment(['remote_file_url' => 'https://example.test/file.pdf', 'candidate_id' => 200]);
        $service->apiGet('/locations', ['limit' => 5]);
        $service->apiPost('/attachments', ['attachment' => ['remote_file_url' => 'https://example.test/file.pdf']]);
        $service->apiPatch('/offers/100', ['offer' => ['status' => 'published']]);
        $service->apiDelete('/candidates/200');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer rt_test'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.recruitee.com/c/company-1/offers?status=published');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.recruitee.com/c/company-1/offers');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.recruitee.com/c/company-1/offers/100');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.recruitee.com/c/company-1/offers/100');
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/search/new/candidates?sort_by=created_at_desc'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.recruitee.com/c/company-1/candidates/200/update_cv');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.recruitee.com/c/company-1/candidates/200/notes');
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/locations?scope=active'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.recruitee.com/c/company-1/attachments');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.recruitee.com/c/company-1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new RecruiteeService('rt_test', 'company-1');

        self::assertTrue((new RecruiteeCreateCandidate($service))->execute([
            'candidate' => ['name' => 'Example Candidate'],
            'offers' => [100],
        ])->succeeded());
        self::assertTrue((new RecruiteeUpdateOffer($service))->execute([
            'id' => 100,
            'offer' => ['title' => 'Senior Support Engineer'],
        ])->succeeded());
        self::assertTrue((new RecruiteeApiGet($service))->execute([
            'path' => '/locations',
            'params' => ['limit' => 5],
        ])->succeeded());
        self::assertFalse((new RecruiteeCreateCandidate($service))->execute([
            'candidate' => [],
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.recruitee.com/c/company-1/departments' => Http::response(['departments' => []], 200),
        ]);

        $provider = new RecruiteeToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('recruitee_create_offer', $tools);
        self::assertArrayHasKey('recruitee_search_candidates', $tools);
        self::assertArrayHasKey('recruitee_update_candidate_cv', $tools);
        self::assertArrayHasKey('recruitee_list_locations', $tools);
        self::assertArrayHasKey('recruitee_upload_attachment', $tools);
        self::assertArrayHasKey('recruitee_api_delete', $tools);
        self::assertSame(21, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'rt_test',
            'company_id' => 'company-1',
        ])['success']);
    }
}
