<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\SignNow;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\SignNow\SignNowService;
use OpenCompany\Integrations\SignNow\SignNowToolProvider;
use OpenCompany\Integrations\SignNow\Tools\SignNowApiGet;
use OpenCompany\Integrations\SignNow\Tools\SignNowSendFreeformInvite;
use OpenCompany\Integrations\SignNow\Tools\SignNowUpdateDocument;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded SignNow API coverage.
 */
final class SignNowServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_documents_templates_invites_downloads_and_generic_endpoints(): void
    {
        Http::fake([
            'https://api.signnow.com/document/doc_1/download*' => Http::response('pdf-body', 200, ['Content-Type' => 'application/pdf']),
            'https://api.signnow.com/*' => Http::response(['ok' => true, 'documents' => []], 200),
        ]);

        $service = new SignNowService('sn_test');

        $service->getCurrentUser();
        $service->listDocuments(2, 10);
        $service->getDocument('doc_1');
        $service->updateDocument('doc_1', ['fields' => []]);
        $service->deleteDocument('doc_1');
        $service->downloadDocument('doc_1', 'collapsed');
        $service->getDocumentDownloadLink('doc_1');
        $service->getDocumentHistory('doc_1');
        $service->mergeDocuments(['document_ids' => ['doc_1', 'doc_2'], 'name' => 'Merged']);
        $service->listTemplates();
        $service->createTemplate('doc_1', 'Template', false);
        $service->duplicateTemplate('template_1', 'Copied');
        $service->deleteTemplate('template_1');
        $service->sendInvite('doc_1', 'signer@example.test', 'sender@example.test', 'Please sign');
        $service->sendFreeformInvite('doc_1', ['to' => [['email' => 'signer@example.test']]]);
        $service->cancelFieldInvite('doc_1');
        $service->cancelFreeformInvite('invite_1');
        $service->apiGet('/document');
        $service->apiPost('/document/merge', ['document_ids' => ['doc_1']]);
        $service->apiPut('/document/doc_1', ['fields' => []]);
        $service->apiDelete('/document/doc_1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer sn_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.signnow.com/user');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.signnow.com/user/documentsv2?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.signnow.com/document/doc_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.signnow.com/document/doc_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.signnow.com/document/doc_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.signnow.com/document/doc_1/download?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.signnow.com/document/doc_1/download/link');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.signnow.com/document/doc_1/history');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.signnow.com/document/merge');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.signnow.com/template');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.signnow.com/template');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.signnow.com/template/template_1/copy');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.signnow.com/template/template_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.signnow.com/document/doc_1/invite');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.signnow.com/document/doc_1/fieldinvitecancel');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.signnow.com/invite/invite_1/cancel');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.signnow.com/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new SignNowService('sn_test');

        self::assertTrue((new SignNowUpdateDocument($service))->execute([
            'document_id' => 'doc_1',
            'payload' => ['fields' => []],
        ])->succeeded());
        self::assertTrue((new SignNowSendFreeformInvite($service))->execute([
            'document_id' => 'doc_1',
            'payload' => ['to' => [['email' => 'signer@example.test']]],
        ])->succeeded());
        self::assertTrue((new SignNowApiGet($service))->execute([
            'path' => '/document',
        ])->succeeded());
        self::assertFalse((new SignNowUpdateDocument($service))->execute([
            'document_id' => 'doc_1',
        ])->succeeded());
        self::assertFalse((new SignNowSendFreeformInvite($service))->execute([
            'document_id' => 'doc_1',
        ])->succeeded());
        self::assertFalse((new SignNowApiGet($service))->execute([
            'path' => 'https://example.test/document',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.signnow.com/user' => Http::response(['email' => 'person@example.test'], 200),
        ]);

        $provider = new SignNowToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('signnow_update_document', $tools);
        self::assertArrayHasKey('signnow_get_document_download_link', $tools);
        self::assertArrayHasKey('signnow_create_template', $tools);
        self::assertArrayHasKey('signnow_send_freeform_invite', $tools);
        self::assertArrayHasKey('signnow_cancel_freeform_invite', $tools);
        self::assertArrayHasKey('signnow_api_delete', $tools);
        self::assertSame(22, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'sn_test',
        ])['success']);
    }
}
