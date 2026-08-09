<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftPlaces;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftPlaces\MicrosoftPlacesService;
use OpenCompany\Integrations\MicrosoftPlaces\MicrosoftPlacesToolProvider;
use OpenCompany\Integrations\MicrosoftPlaces\Tools\MicrosoftPlacesPlacesAsBuildingMapListLevels;
use OpenCompany\Integrations\MicrosoftPlaces\Tools\MicrosoftPlacesPlacesAsRoomListListRooms;
use OpenCompany\Integrations\MicrosoftPlaces\Tools\MicrosoftPlacesPlacesListCheckIns;
use OpenCompany\Integrations\MicrosoftPlaces\Tools\MicrosoftPlacesPlacesPlaceGetPlaceAsRoom;
use OpenCompany\Integrations\MicrosoftPlaces\Tools\MicrosoftPlacesPlacesPlaceListPlaceAsRoom;
use OpenCompany\Integrations\MicrosoftPlaces\Tools\MicrosoftPlacesPlacesPlaceUpdatePlace;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Places integration.
 */
final class MicrosoftPlacesServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        parent::tearDown();
    }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new MicrosoftPlacesToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-places/microsoft-places-openapi-manifest.json'), true);

        self::assertSame(131, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertContains('/places', $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Places', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('microsoft_places_places_place_list_place_as_room', array_keys($provider->tools()));
        self::assertContains('microsoft_places_places_place_get_place_as_room', array_keys($provider->tools()));
        self::assertContains('microsoft_places_places_as_room_list_list_rooms', array_keys($provider->tools()));
        self::assertContains('microsoft_places_places_as_building_map_list_levels', array_keys($provider->tools()));
        self::assertContains('microsoft_places_places_list_check_ins', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_places_headers_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftPlacesService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/places/{place-id}/graph.room', ['place-id' => 'room 1'], ['$select' => 'id,displayName']);
        $service->request(
            'PATCH',
            '/places/{place-id}',
            ['place-id' => 'room 1'],
            [],
            ['If-Match' => 'W/"etag"', 'Prefer' => 'return=representation', 'ConsistencyLevel' => 'eventual'],
            ['displayName' => 'Updated Room'],
        );

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/places/room%201/graph.room?%24select=id%2CdisplayName'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://graph.example.test/v1.0/places/room%201'
            && $request->hasHeader('If-Match', 'W/"etag"')
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->hasHeader('ConsistencyLevel', 'eventual')
            && $request->data()['displayName'] === 'Updated Room');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftPlacesService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftPlacesPlacesPlaceListPlaceAsRoom($service))->execute(['top' => 5, 'select' => 'id,displayName', 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftPlacesPlacesPlaceGetPlaceAsRoom($service))->execute(['place_id' => 'room-123', 'select' => 'id,displayName'])->succeeded());
        self::assertTrue((new MicrosoftPlacesPlacesPlaceUpdatePlace($service))->execute(['place_id' => 'room-123', 'if_match' => 'W/"etag"', 'body' => ['displayName' => 'Updated']])->succeeded());
        self::assertTrue((new MicrosoftPlacesPlacesAsRoomListListRooms($service))->execute(['place_id' => 'room-list-123', 'top' => 2])->succeeded());
        self::assertTrue((new MicrosoftPlacesPlacesAsBuildingMapListLevels($service))->execute(['place_id' => 'building-123'])->succeeded());
        self::assertTrue((new MicrosoftPlacesPlacesListCheckIns($service))->execute(['place_id' => 'room-123', 'filter' => "status eq 'checkedIn'"])->succeeded());

        $missingPath = (new MicrosoftPlacesPlacesPlaceGetPlaceAsRoom($service))->execute([]);
        $badBody = (new MicrosoftPlacesPlacesPlaceUpdatePlace($service))->execute(['place_id' => 'room-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftPlacesPlacesPlaceUpdatePlace($service))->execute(['place_id' => 'room-123']);
        $unconfigured = (new MicrosoftPlacesPlacesPlaceGetPlaceAsRoom(new MicrosoftPlacesService('', 'https://graph.example.test/v1.0')))->execute(['place_id' => 'room-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('place_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_places_probe(): void
    {
        Http::fake(['*' => Http::response(['value' => []], 200)]);

        $result = (new MicrosoftPlacesToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/places?$top=1'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            /** @var list<string> */
            public array $seenIntegrations = [];

            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $this->seenIntegrations[] = $integration;

                $values = [
                    'access_token' => $account === 'work' ? 'work-token' : 'default-token',
                    'base_url' => 'https://graph.example.test/v1.0',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $resolver = Container::getInstance()->make(CredentialResolver::class);
        $tool = (new MicrosoftPlacesToolProvider)->createTool(MicrosoftPlacesPlacesPlaceGetPlaceAsRoom::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['place_id' => 'room-123'])->succeeded());

        self::assertSame(['microsoft-places', 'microsoft-places'], $resolver->seenIntegrations);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
