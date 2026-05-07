<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Pushover;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Pushover\PushoverService;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Pushover endpoint coverage and form payload mappings.
 */
final class PushoverServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_send_message_maps_extended_message_fields(): void
    {
        Http::fake([
            'https://api.pushover.net/1/messages.json' => Http::response([
                'status' => 1,
                'request' => 'req-example',
                'receipt' => 'receipt-example',
            ], 200),
        ]);

        $service = new PushoverService(apiKey: 'app-token', userKey: 'user-key');
        $service->sendMessage('Example message', 'Example title', 2, [
            'retry' => 60,
            'expire' => 3600,
            'callback' => 'https://example.test/pushover/callback',
            'tags' => 'incident-1',
            'ttl' => 120,
            'html' => 1,
        ]);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.pushover.net/1/messages.json'
                && $request->data()['token'] === 'app-token'
                && $request->data()['user'] === 'user-key'
                && $request->data()['message'] === 'Example message'
                && $request->data()['priority'] === 2
                && $request->data()['retry'] === 60
                && $request->data()['expire'] === 3600
                && $request->data()['callback'] === 'https://example.test/pushover/callback'
                && $request->data()['tags'] === 'incident-1'
                && $request->data()['ttl'] === 120
                && $request->data()['html'] === 1;
        });
    }

    public function test_application_limits_and_sounds_do_not_send_user_key(): void
    {
        Http::fake([
            'https://api.pushover.net/1/apps/limits.json*' => Http::response(['limit' => 10000], 200),
            'https://api.pushover.net/1/sounds.json*' => Http::response(['sounds' => []], 200),
        ]);

        $service = new PushoverService(apiKey: 'app-token', userKey: 'user-key');
        $service->getApplicationLimits();
        $service->listSounds();

        Http::assertSent(static function (Request $request): bool {
            return in_array($request->url(), [
                'https://api.pushover.net/1/apps/limits.json?token=app-token',
                'https://api.pushover.net/1/sounds.json?token=app-token',
            ], true);
        });

        Http::assertNotSent(static function (Request $request): bool {
            return str_contains($request->url(), 'user=');
        });
    }

    public function test_validate_user_can_validate_arbitrary_user_and_device(): void
    {
        Http::fake([
            'https://api.pushover.net/1/users/validate.json' => Http::response(['status' => 1, 'devices' => ['iphone']], 200),
        ]);

        $service = new PushoverService(apiKey: 'app-token', userKey: 'default-user');
        $service->validateUser('other-user', 'iphone');

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.pushover.net/1/users/validate.json'
                && $request->data()['token'] === 'app-token'
                && $request->data()['user'] === 'other-user'
                && $request->data()['device'] === 'iphone';
        });
    }

    public function test_receipt_endpoints_map_to_official_paths(): void
    {
        Http::fake([
            'https://api.pushover.net/1/receipts/r-example.json*' => Http::response(['acknowledged' => 0], 200),
            'https://api.pushover.net/1/receipts/r-example/cancel.json' => Http::response(['status' => 1], 200),
            'https://api.pushover.net/1/receipts/cancel_by_tag/incident-1.json' => Http::response(['status' => 1], 200),
        ]);

        $service = new PushoverService(apiKey: 'app-token', userKey: 'user-key');
        $service->getReceipt('r-example');
        $service->cancelReceipt('r-example');
        $service->cancelReceiptsByTag('incident-1');

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/receipts/r-example.json?token=app-token');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/receipts/r-example/cancel.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/receipts/cancel_by_tag/incident-1.json');
    }

    public function test_subscription_migration_maps_to_official_path(): void
    {
        Http::fake([
            'https://api.pushover.net/1/subscriptions/migrate.json' => Http::response([
                'status' => 1,
                'subscribed_user_key' => 'subscribed-example',
            ], 200),
        ]);

        $service = new PushoverService(apiKey: 'app-token', userKey: 'default-user');
        $service->migrateSubscriptionUser('subscription-code', 'user-key', [
            'device_name' => 'iphone',
            'sound' => 'pushover',
        ]);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.pushover.net/1/subscriptions/migrate.json'
                && $request->data()['token'] === 'app-token'
                && $request->data()['subscription'] === 'subscription-code'
                && $request->data()['user'] === 'user-key'
                && $request->data()['device_name'] === 'iphone'
                && $request->data()['sound'] === 'pushover';
        });
    }

    public function test_team_endpoints_use_team_token(): void
    {
        Http::fake([
            'https://api.pushover.net/1/teams.json*' => Http::response(['name' => 'Example Team'], 200),
            'https://api.pushover.net/1/teams/add_user.json' => Http::response(['status' => 1], 200),
            'https://api.pushover.net/1/teams/remove_user.json' => Http::response(['status' => 1], 200),
        ]);

        $service = new PushoverService(
            apiKey: 'app-token',
            userKey: 'default-user',
            teamToken: 'team-token',
        );

        $service->getTeam();
        $service->addTeamUser([
            'email' => 'person@example.test',
            'name' => 'Example Person',
            'instant' => 'true',
        ]);
        $service->removeTeamUser('person@example.test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.pushover.net/1/teams.json?token=team-token');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/teams/add_user.json' && $request->data()['token'] === 'team-token' && $request->data()['email'] === 'person@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/teams/remove_user.json' && $request->data()['token'] === 'team-token' && $request->data()['email'] === 'person@example.test');
    }

    public function test_group_endpoints_map_to_official_paths(): void
    {
        Http::fake([
            'https://api.pushover.net/1/groups.json*' => Http::response(['groups' => []], 200),
            'https://api.pushover.net/1/groups/g-example.json*' => Http::response(['name' => 'Ops'], 200),
            'https://api.pushover.net/1/groups/g-example/add_user.json' => Http::response(['status' => 1], 200),
            'https://api.pushover.net/1/groups/g-example/remove_user.json' => Http::response(['status' => 1], 200),
            'https://api.pushover.net/1/groups/g-example/disable_user.json' => Http::response(['status' => 1], 200),
            'https://api.pushover.net/1/groups/g-example/enable_user.json' => Http::response(['status' => 1], 200),
            'https://api.pushover.net/1/groups/g-example/rename.json' => Http::response(['status' => 1], 200),
        ]);

        $service = new PushoverService(apiKey: 'app-token', userKey: 'user-key');
        $service->createGroup('Ops');
        $service->listGroups();
        $service->getGroup('g-example');
        $service->addGroupUser('g-example', 'u-example', ['memo' => 'On call']);
        $service->removeGroupUser('g-example', 'u-example');
        $service->disableGroupUser('g-example', 'u-example');
        $service->enableGroupUser('g-example', 'u-example');
        $service->renameGroup('g-example', 'Support');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushover.net/1/groups.json' && $request->data()['name'] === 'Ops');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.pushover.net/1/groups.json?token=app-token');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.pushover.net/1/groups/g-example.json?token=app-token');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/groups/g-example/add_user.json' && $request->data()['user'] === 'u-example');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/groups/g-example/remove_user.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/groups/g-example/disable_user.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/groups/g-example/enable_user.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/groups/g-example/rename.json' && $request->data()['name'] === 'Support');
    }

    public function test_glance_and_license_endpoints_map_to_official_paths(): void
    {
        Http::fake([
            'https://api.pushover.net/1/glances.json' => Http::response(['status' => 1], 200),
            'https://api.pushover.net/1/licenses.json*' => Http::response(['credits' => 3], 200),
            'https://api.pushover.net/1/licenses/assign.json' => Http::response(['status' => 1], 200),
        ]);

        $service = new PushoverService(apiKey: 'app-token', userKey: 'user-key');
        $service->updateGlance(['title' => 'Queue', 'count' => 3]);
        $service->getLicenseCredits();
        $service->assignLicense(['email' => 'person@example.test', 'os' => 'Android']);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/glances.json' && $request->data()['user'] === 'user-key');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/licenses.json?token=app-token');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.pushover.net/1/licenses/assign.json' && $request->data()['email'] === 'person@example.test');
    }
}
