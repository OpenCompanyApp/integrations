<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleClassroom;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleClassroom\GoogleClassroomService;
use OpenCompany\Integrations\GoogleClassroom\GoogleClassroomToolProvider;
use OpenCompany\Integrations\GoogleClassroom\Tools\GoogleClassroomCoursesCreate;
use OpenCompany\Integrations\GoogleClassroom\Tools\GoogleClassroomCoursesList;
use OpenCompany\Integrations\GoogleClassroom\Tools\GoogleClassroomUserProfilesGuardiansGet;
use PHPUnit\Framework\TestCase;

final class GoogleClassroomServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleClassroomToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-classroom/google-classroom-discovery-manifest.json'), true);

        self::assertSame(104, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Classroom', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-classroom/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_classroom_courses_list', $manifestTools);
        self::assertContains('google_classroom_courses_course_work_student_submissions_turn_in', $manifestTools);
        self::assertContains('google_classroom_user_profiles_guardian_invitations_create', $manifestTools);
        self::assertContains('google_classroom_registrations_create', $manifestTools);
    }

    public function test_service_maps_auth_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleClassroomService('token-test', 'https://example.test');
        $service->request('GET', '/v1/courses/{courseId}/courseWork', ['courseId' => 'course-1'], [], ['pageSize' => 5]);
        $service->request('POST', '/v1/courses', [], [], [], ['name' => 'Agent Operations', 'ownerId' => 'me']);
        $service->request('GET', '/v1/userProfiles/{studentId}/guardians/{guardianId}', ['studentId' => 'person@example.test', 'guardianId' => 'guardian-1']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/courses/course-1/courseWork?pageSize=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v1/courses'
            && $request['name'] === 'Agent Operations');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v1/userProfiles/person%40example.test/guardians/guardian-1');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleClassroomService('token-test');

        $list = new GoogleClassroomCoursesList($service);
        $result = $list->execute(['pageSize' => 10, 'courseStates' => ['ACTIVE'], 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://classroom.googleapis.com/v1/courses?pageSize=10&courseStates=%5B%22ACTIVE%22%5D');

        $missingPath = (new GoogleClassroomUserProfilesGuardiansGet($service))->execute(['studentId' => 'person@example.test']);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('guardianId must be', (string) $missingPath->error);

        $missingBody = (new GoogleClassroomCoursesCreate($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}
