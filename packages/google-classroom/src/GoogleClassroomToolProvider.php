<?php

namespace OpenCompany\Integrations\GoogleClassroom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Classroom.
 *
 * Exposes generated coverage for the official Classroom v1 Discovery document,
 * including courses, rosters, coursework, submissions, guardians, invitations,
 * registrations, topics, announcements, materials, and add-on attachments.
 */
class GoogleClassroomToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Google Classroom scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-classroom'; }
    public function appMeta(): array { return ['label' => 'Google Classroom', 'description' => 'Courses, rosters, coursework, submissions, guardians, invitations, registrations, topics, and add-ons', 'icon' => 'ph:chalkboard-teacher', 'logo' => 'logos:google-icon']; }
    public function integrationMeta(): array { return ['name' => 'Google Classroom', 'description' => 'Generated coverage for the Classroom v1 REST API: courses, teachers, students, aliases, coursework, submissions, rubrics, announcements, materials, topics, guardians, invitations, registrations, and add-on attachments.', 'icon' => 'ph:chalkboard-teacher', 'logo' => 'logos:google-icon', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/workspace/classroom/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Google Classroom scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://classroom.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://classroom.googleapis.com']]; }

    /**
     * Verify Google Classroom credentials with a lightweight courses list call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://classroom.googleapis.com'), '/');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer '.$accessToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl.'/v1/courses', ['pageSize' => 1]);
            if (!$response->successful()) return ['success' => false, 'error' => 'Google Classroom API returned HTTP '.$response->status().'.'];
            return ['success' => true, 'message' => "Connected to Google Classroom at {$baseUrl}."];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_classroom_user_profiles_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomUserProfilesGet',
  'type' => 'read',
  'name' => 'User Profiles Get',
  'description' => 'User Profiles Get (GET /v1/userProfiles/{userId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_user_profiles_guardian_invitations_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomUserProfilesGuardianInvitationsList',
  'type' => 'read',
  'name' => 'User Profiles Guardian Invitations List',
  'description' => 'User Profiles Guardian Invitations List (GET /v1/userProfiles/{studentId}/guardianInvitations).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_user_profiles_guardian_invitations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomUserProfilesGuardianInvitationsGet',
  'type' => 'read',
  'name' => 'User Profiles Guardian Invitations Get',
  'description' => 'User Profiles Guardian Invitations Get (GET /v1/userProfiles/{studentId}/guardianInvitations/{invitationId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_user_profiles_guardian_invitations_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomUserProfilesGuardianInvitationsPatch',
  'type' => 'write',
  'name' => 'User Profiles Guardian Invitations Patch',
  'description' => 'User Profiles Guardian Invitations Patch (PATCH /v1/userProfiles/{studentId}/guardianInvitations/{invitationId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_user_profiles_guardian_invitations_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomUserProfilesGuardianInvitationsCreate',
  'type' => 'write',
  'name' => 'User Profiles Guardian Invitations Create',
  'description' => 'User Profiles Guardian Invitations Create (POST /v1/userProfiles/{studentId}/guardianInvitations).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_user_profiles_guardians_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomUserProfilesGuardiansList',
  'type' => 'read',
  'name' => 'User Profiles Guardians List',
  'description' => 'User Profiles Guardians List (GET /v1/userProfiles/{studentId}/guardians).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_user_profiles_guardians_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomUserProfilesGuardiansGet',
  'type' => 'read',
  'name' => 'User Profiles Guardians Get',
  'description' => 'User Profiles Guardians Get (GET /v1/userProfiles/{studentId}/guardians/{guardianId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_user_profiles_guardians_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomUserProfilesGuardiansDelete',
  'type' => 'write',
  'name' => 'User Profiles Guardians Delete',
  'description' => 'User Profiles Guardians Delete (DELETE /v1/userProfiles/{studentId}/guardians/{guardianId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_invitations_accept' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomInvitationsAccept',
  'type' => 'write',
  'name' => 'Invitations Accept',
  'description' => 'Invitations Accept (POST /v1/invitations/{id}:accept).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_invitations_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomInvitationsDelete',
  'type' => 'write',
  'name' => 'Invitations Delete',
  'description' => 'Invitations Delete (DELETE /v1/invitations/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_invitations_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomInvitationsList',
  'type' => 'read',
  'name' => 'Invitations List',
  'description' => 'Invitations List (GET /v1/invitations).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_invitations_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomInvitationsCreate',
  'type' => 'write',
  'name' => 'Invitations Create',
  'description' => 'Invitations Create (POST /v1/invitations).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_invitations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomInvitationsGet',
  'type' => 'read',
  'name' => 'Invitations Get',
  'description' => 'Invitations Get (GET /v1/invitations/{id}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCreate',
  'type' => 'write',
  'name' => 'Courses Create',
  'description' => 'Courses Create (POST /v1/courses).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesUpdate',
  'type' => 'write',
  'name' => 'Courses Update',
  'description' => 'Courses Update (PUT /v1/courses/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_update_grading_period_settings' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesUpdateGradingPeriodSettings',
  'type' => 'write',
  'name' => 'Courses Update Grading Period Settings',
  'description' => 'Courses Update Grading Period Settings (PATCH /v1/courses/{courseId}/gradingPeriodSettings).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesGet',
  'type' => 'read',
  'name' => 'Courses Get',
  'description' => 'Courses Get (GET /v1/courses/{id}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_get_grading_period_settings' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesGetGradingPeriodSettings',
  'type' => 'read',
  'name' => 'Courses Get Grading Period Settings',
  'description' => 'Courses Get Grading Period Settings (GET /v1/courses/{courseId}/gradingPeriodSettings).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesPatch',
  'type' => 'write',
  'name' => 'Courses Patch',
  'description' => 'Courses Patch (PATCH /v1/courses/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesList',
  'type' => 'read',
  'name' => 'Courses List',
  'description' => 'Courses List (GET /v1/courses).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesDelete',
  'type' => 'write',
  'name' => 'Courses Delete',
  'description' => 'Courses Delete (DELETE /v1/courses/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkGet',
  'type' => 'read',
  'name' => 'Courses Course Work Get',
  'description' => 'Courses Course Work Get (GET /v1/courses/{courseId}/courseWork/{id}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkCreate',
  'type' => 'write',
  'name' => 'Courses Course Work Create',
  'description' => 'Courses Course Work Create (POST /v1/courses/{courseId}/courseWork).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_modify_assignees' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkModifyAssignees',
  'type' => 'write',
  'name' => 'Courses Course Work Modify Assignees',
  'description' => 'Courses Course Work Modify Assignees (POST /v1/courses/{courseId}/courseWork/{id}:modifyAssignees).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkPatch',
  'type' => 'write',
  'name' => 'Courses Course Work Patch',
  'description' => 'Courses Course Work Patch (PATCH /v1/courses/{courseId}/courseWork/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkList',
  'type' => 'read',
  'name' => 'Courses Course Work List',
  'description' => 'Courses Course Work List (GET /v1/courses/{courseId}/courseWork).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_get_add_on_context' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkGetAddOnContext',
  'type' => 'read',
  'name' => 'Courses Course Work Get Add On Context',
  'description' => 'Courses Course Work Get Add On Context (GET /v1/courses/{courseId}/courseWork/{itemId}/addOnContext).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_update_rubric' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkUpdateRubric',
  'type' => 'write',
  'name' => 'Courses Course Work Update Rubric',
  'description' => 'Courses Course Work Update Rubric (PATCH /v1/courses/{courseId}/courseWork/{courseWorkId}/rubric).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkDelete',
  'type' => 'write',
  'name' => 'Courses Course Work Delete',
  'description' => 'Courses Course Work Delete (DELETE /v1/courses/{courseId}/courseWork/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_rubrics_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkRubricsGet',
  'type' => 'read',
  'name' => 'Courses Course Work Rubrics Get',
  'description' => 'Courses Course Work Rubrics Get (GET /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics/{id}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_rubrics_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkRubricsCreate',
  'type' => 'write',
  'name' => 'Courses Course Work Rubrics Create',
  'description' => 'Courses Course Work Rubrics Create (POST /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_rubrics_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkRubricsPatch',
  'type' => 'write',
  'name' => 'Courses Course Work Rubrics Patch',
  'description' => 'Courses Course Work Rubrics Patch (PATCH /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_rubrics_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkRubricsList',
  'type' => 'read',
  'name' => 'Courses Course Work Rubrics List',
  'description' => 'Courses Course Work Rubrics List (GET /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_rubrics_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkRubricsDelete',
  'type' => 'write',
  'name' => 'Courses Course Work Rubrics Delete',
  'description' => 'Courses Course Work Rubrics Delete (DELETE /v1/courses/{courseId}/courseWork/{courseWorkId}/rubrics/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_student_submissions_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkStudentSubmissionsPatch',
  'type' => 'write',
  'name' => 'Courses Course Work Student Submissions Patch',
  'description' => 'Courses Course Work Student Submissions Patch (PATCH /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_student_submissions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkStudentSubmissionsList',
  'type' => 'read',
  'name' => 'Courses Course Work Student Submissions List',
  'description' => 'Courses Course Work Student Submissions List (GET /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_student_submissions_return' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkStudentSubmissionsReturn',
  'type' => 'write',
  'name' => 'Courses Course Work Student Submissions Return',
  'description' => 'Courses Course Work Student Submissions Return (POST /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions/{id}:return).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_student_submissions_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkStudentSubmissionsGet',
  'type' => 'read',
  'name' => 'Courses Course Work Student Submissions Get',
  'description' => 'Courses Course Work Student Submissions Get (GET /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions/{id}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_student_submissions_modify_attachments' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkStudentSubmissionsModifyAttachments',
  'type' => 'write',
  'name' => 'Courses Course Work Student Submissions Modify Attachments',
  'description' => 'Courses Course Work Student Submissions Modify Attachments (POST /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions/{id}:modifyAttachments).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_student_submissions_turn_in' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkStudentSubmissionsTurnIn',
  'type' => 'write',
  'name' => 'Courses Course Work Student Submissions Turn In',
  'description' => 'Courses Course Work Student Submissions Turn In (POST /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions/{id}:turnIn).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_student_submissions_reclaim' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkStudentSubmissionsReclaim',
  'type' => 'write',
  'name' => 'Courses Course Work Student Submissions Reclaim',
  'description' => 'Courses Course Work Student Submissions Reclaim (POST /v1/courses/{courseId}/courseWork/{courseWorkId}/studentSubmissions/{id}:reclaim).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_add_on_attachments_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkAddOnAttachmentsCreate',
  'type' => 'write',
  'name' => 'Courses Course Work Add On Attachments Create',
  'description' => 'Courses Course Work Add On Attachments Create (POST /v1/courses/{courseId}/courseWork/{itemId}/addOnAttachments).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_add_on_attachments_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkAddOnAttachmentsGet',
  'type' => 'read',
  'name' => 'Courses Course Work Add On Attachments Get',
  'description' => 'Courses Course Work Add On Attachments Get (GET /v1/courses/{courseId}/courseWork/{itemId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_add_on_attachments_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkAddOnAttachmentsList',
  'type' => 'read',
  'name' => 'Courses Course Work Add On Attachments List',
  'description' => 'Courses Course Work Add On Attachments List (GET /v1/courses/{courseId}/courseWork/{itemId}/addOnAttachments).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_add_on_attachments_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkAddOnAttachmentsPatch',
  'type' => 'write',
  'name' => 'Courses Course Work Add On Attachments Patch',
  'description' => 'Courses Course Work Add On Attachments Patch (PATCH /v1/courses/{courseId}/courseWork/{itemId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_add_on_attachments_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkAddOnAttachmentsDelete',
  'type' => 'write',
  'name' => 'Courses Course Work Add On Attachments Delete',
  'description' => 'Courses Course Work Add On Attachments Delete (DELETE /v1/courses/{courseId}/courseWork/{itemId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_add_on_attachments_student_submissions_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkAddOnAttachmentsStudentSubmissionsPatch',
  'type' => 'write',
  'name' => 'Courses Course Work Add On Attachments Student Submissions Patch',
  'description' => 'Courses Course Work Add On Attachments Student Submissions Patch (PATCH /v1/courses/{courseId}/courseWork/{itemId}/addOnAttachments/{attachmentId}/studentSubmissions/{submissionId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_add_on_attachments_student_submissions_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkAddOnAttachmentsStudentSubmissionsGet',
  'type' => 'read',
  'name' => 'Courses Course Work Add On Attachments Student Submissions Get',
  'description' => 'Courses Course Work Add On Attachments Student Submissions Get (GET /v1/courses/{courseId}/courseWork/{itemId}/addOnAttachments/{attachmentId}/studentSubmissions/{submissionId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_posts_get_add_on_context' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesPostsGetAddOnContext',
  'type' => 'read',
  'name' => 'Courses Posts Get Add On Context',
  'description' => 'Courses Posts Get Add On Context (GET /v1/courses/{courseId}/posts/{postId}/addOnContext).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_posts_add_on_attachments_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesPostsAddOnAttachmentsDelete',
  'type' => 'write',
  'name' => 'Courses Posts Add On Attachments Delete',
  'description' => 'Courses Posts Add On Attachments Delete (DELETE /v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_posts_add_on_attachments_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesPostsAddOnAttachmentsList',
  'type' => 'read',
  'name' => 'Courses Posts Add On Attachments List',
  'description' => 'Courses Posts Add On Attachments List (GET /v1/courses/{courseId}/posts/{postId}/addOnAttachments).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_posts_add_on_attachments_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesPostsAddOnAttachmentsPatch',
  'type' => 'write',
  'name' => 'Courses Posts Add On Attachments Patch',
  'description' => 'Courses Posts Add On Attachments Patch (PATCH /v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_posts_add_on_attachments_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesPostsAddOnAttachmentsGet',
  'type' => 'read',
  'name' => 'Courses Posts Add On Attachments Get',
  'description' => 'Courses Posts Add On Attachments Get (GET /v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_posts_add_on_attachments_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesPostsAddOnAttachmentsCreate',
  'type' => 'write',
  'name' => 'Courses Posts Add On Attachments Create',
  'description' => 'Courses Posts Add On Attachments Create (POST /v1/courses/{courseId}/posts/{postId}/addOnAttachments).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_posts_add_on_attachments_student_submissions_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesPostsAddOnAttachmentsStudentSubmissionsPatch',
  'type' => 'write',
  'name' => 'Courses Posts Add On Attachments Student Submissions Patch',
  'description' => 'Courses Posts Add On Attachments Student Submissions Patch (PATCH /v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}/studentSubmissions/{submissionId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_posts_add_on_attachments_student_submissions_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesPostsAddOnAttachmentsStudentSubmissionsGet',
  'type' => 'read',
  'name' => 'Courses Posts Add On Attachments Student Submissions Get',
  'description' => 'Courses Posts Add On Attachments Student Submissions Get (GET /v1/courses/{courseId}/posts/{postId}/addOnAttachments/{attachmentId}/studentSubmissions/{submissionId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_topics_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesTopicsGet',
  'type' => 'read',
  'name' => 'Courses Topics Get',
  'description' => 'Courses Topics Get (GET /v1/courses/{courseId}/topics/{id}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_topics_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesTopicsCreate',
  'type' => 'write',
  'name' => 'Courses Topics Create',
  'description' => 'Courses Topics Create (POST /v1/courses/{courseId}/topics).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_topics_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesTopicsPatch',
  'type' => 'write',
  'name' => 'Courses Topics Patch',
  'description' => 'Courses Topics Patch (PATCH /v1/courses/{courseId}/topics/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_topics_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesTopicsList',
  'type' => 'read',
  'name' => 'Courses Topics List',
  'description' => 'Courses Topics List (GET /v1/courses/{courseId}/topics).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_topics_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesTopicsDelete',
  'type' => 'write',
  'name' => 'Courses Topics Delete',
  'description' => 'Courses Topics Delete (DELETE /v1/courses/{courseId}/topics/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_aliases_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAliasesList',
  'type' => 'read',
  'name' => 'Courses Aliases List',
  'description' => 'Courses Aliases List (GET /v1/courses/{courseId}/aliases).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_aliases_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAliasesDelete',
  'type' => 'write',
  'name' => 'Courses Aliases Delete',
  'description' => 'Courses Aliases Delete (DELETE /v1/courses/{courseId}/aliases/{alias}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_aliases_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAliasesCreate',
  'type' => 'write',
  'name' => 'Courses Aliases Create',
  'description' => 'Courses Aliases Create (POST /v1/courses/{courseId}/aliases).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_students_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentsCreate',
  'type' => 'write',
  'name' => 'Courses Students Create',
  'description' => 'Courses Students Create (POST /v1/courses/{courseId}/students).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_students_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentsDelete',
  'type' => 'write',
  'name' => 'Courses Students Delete',
  'description' => 'Courses Students Delete (DELETE /v1/courses/{courseId}/students/{userId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_students_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentsGet',
  'type' => 'read',
  'name' => 'Courses Students Get',
  'description' => 'Courses Students Get (GET /v1/courses/{courseId}/students/{userId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_students_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentsList',
  'type' => 'read',
  'name' => 'Courses Students List',
  'description' => 'Courses Students List (GET /v1/courses/{courseId}/students).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_teachers_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesTeachersGet',
  'type' => 'read',
  'name' => 'Courses Teachers Get',
  'description' => 'Courses Teachers Get (GET /v1/courses/{courseId}/teachers/{userId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_teachers_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesTeachersList',
  'type' => 'read',
  'name' => 'Courses Teachers List',
  'description' => 'Courses Teachers List (GET /v1/courses/{courseId}/teachers).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_teachers_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesTeachersDelete',
  'type' => 'write',
  'name' => 'Courses Teachers Delete',
  'description' => 'Courses Teachers Delete (DELETE /v1/courses/{courseId}/teachers/{userId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_teachers_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesTeachersCreate',
  'type' => 'write',
  'name' => 'Courses Teachers Create',
  'description' => 'Courses Teachers Create (POST /v1/courses/{courseId}/teachers).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_announcements_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsGet',
  'type' => 'read',
  'name' => 'Courses Announcements Get',
  'description' => 'Courses Announcements Get (GET /v1/courses/{courseId}/announcements/{id}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_announcements_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsCreate',
  'type' => 'write',
  'name' => 'Courses Announcements Create',
  'description' => 'Courses Announcements Create (POST /v1/courses/{courseId}/announcements).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_announcements_modify_assignees' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsModifyAssignees',
  'type' => 'write',
  'name' => 'Courses Announcements Modify Assignees',
  'description' => 'Courses Announcements Modify Assignees (POST /v1/courses/{courseId}/announcements/{id}:modifyAssignees).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_announcements_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsList',
  'type' => 'read',
  'name' => 'Courses Announcements List',
  'description' => 'Courses Announcements List (GET /v1/courses/{courseId}/announcements).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_announcements_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsPatch',
  'type' => 'write',
  'name' => 'Courses Announcements Patch',
  'description' => 'Courses Announcements Patch (PATCH /v1/courses/{courseId}/announcements/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_announcements_get_add_on_context' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsGetAddOnContext',
  'type' => 'read',
  'name' => 'Courses Announcements Get Add On Context',
  'description' => 'Courses Announcements Get Add On Context (GET /v1/courses/{courseId}/announcements/{itemId}/addOnContext).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_announcements_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsDelete',
  'type' => 'write',
  'name' => 'Courses Announcements Delete',
  'description' => 'Courses Announcements Delete (DELETE /v1/courses/{courseId}/announcements/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_announcements_add_on_attachments_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsAddOnAttachmentsCreate',
  'type' => 'write',
  'name' => 'Courses Announcements Add On Attachments Create',
  'description' => 'Courses Announcements Add On Attachments Create (POST /v1/courses/{courseId}/announcements/{itemId}/addOnAttachments).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_announcements_add_on_attachments_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsAddOnAttachmentsGet',
  'type' => 'read',
  'name' => 'Courses Announcements Add On Attachments Get',
  'description' => 'Courses Announcements Add On Attachments Get (GET /v1/courses/{courseId}/announcements/{itemId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_announcements_add_on_attachments_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsAddOnAttachmentsList',
  'type' => 'read',
  'name' => 'Courses Announcements Add On Attachments List',
  'description' => 'Courses Announcements Add On Attachments List (GET /v1/courses/{courseId}/announcements/{itemId}/addOnAttachments).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_announcements_add_on_attachments_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsAddOnAttachmentsPatch',
  'type' => 'write',
  'name' => 'Courses Announcements Add On Attachments Patch',
  'description' => 'Courses Announcements Add On Attachments Patch (PATCH /v1/courses/{courseId}/announcements/{itemId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_announcements_add_on_attachments_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesAnnouncementsAddOnAttachmentsDelete',
  'type' => 'write',
  'name' => 'Courses Announcements Add On Attachments Delete',
  'description' => 'Courses Announcements Add On Attachments Delete (DELETE /v1/courses/{courseId}/announcements/{itemId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_student_groups_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentGroupsCreate',
  'type' => 'write',
  'name' => 'Courses Student Groups Create',
  'description' => 'Courses Student Groups Create (POST /v1/courses/{courseId}/studentGroups).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_student_groups_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentGroupsDelete',
  'type' => 'write',
  'name' => 'Courses Student Groups Delete',
  'description' => 'Courses Student Groups Delete (DELETE /v1/courses/{courseId}/studentGroups/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_student_groups_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentGroupsPatch',
  'type' => 'write',
  'name' => 'Courses Student Groups Patch',
  'description' => 'Courses Student Groups Patch (PATCH /v1/courses/{courseId}/studentGroups/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_student_groups_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentGroupsList',
  'type' => 'read',
  'name' => 'Courses Student Groups List',
  'description' => 'Courses Student Groups List (GET /v1/courses/{courseId}/studentGroups).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_student_groups_student_group_members_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentGroupsStudentGroupMembersDelete',
  'type' => 'write',
  'name' => 'Courses Student Groups Student Group Members Delete',
  'description' => 'Courses Student Groups Student Group Members Delete (DELETE /v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers/{userId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_student_groups_student_group_members_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentGroupsStudentGroupMembersList',
  'type' => 'read',
  'name' => 'Courses Student Groups Student Group Members List',
  'description' => 'Courses Student Groups Student Group Members List (GET /v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_student_groups_student_group_members_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesStudentGroupsStudentGroupMembersCreate',
  'type' => 'write',
  'name' => 'Courses Student Groups Student Group Members Create',
  'description' => 'Courses Student Groups Student Group Members Create (POST /v1/courses/{courseId}/studentGroups/{studentGroupId}/studentGroupMembers).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_materials_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsList',
  'type' => 'read',
  'name' => 'Courses Course Work Materials List',
  'description' => 'Courses Course Work Materials List (GET /v1/courses/{courseId}/courseWorkMaterials).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_materials_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsPatch',
  'type' => 'write',
  'name' => 'Courses Course Work Materials Patch',
  'description' => 'Courses Course Work Materials Patch (PATCH /v1/courses/{courseId}/courseWorkMaterials/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_materials_get_add_on_context' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsGetAddOnContext',
  'type' => 'read',
  'name' => 'Courses Course Work Materials Get Add On Context',
  'description' => 'Courses Course Work Materials Get Add On Context (GET /v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnContext).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_materials_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsDelete',
  'type' => 'write',
  'name' => 'Courses Course Work Materials Delete',
  'description' => 'Courses Course Work Materials Delete (DELETE /v1/courses/{courseId}/courseWorkMaterials/{id}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_materials_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsCreate',
  'type' => 'write',
  'name' => 'Courses Course Work Materials Create',
  'description' => 'Courses Course Work Materials Create (POST /v1/courses/{courseId}/courseWorkMaterials).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_materials_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsGet',
  'type' => 'read',
  'name' => 'Courses Course Work Materials Get',
  'description' => 'Courses Course Work Materials Get (GET /v1/courses/{courseId}/courseWorkMaterials/{id}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_materials_add_on_attachments_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsAddOnAttachmentsCreate',
  'type' => 'write',
  'name' => 'Courses Course Work Materials Add On Attachments Create',
  'description' => 'Courses Course Work Materials Add On Attachments Create (POST /v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnAttachments).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_materials_add_on_attachments_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsAddOnAttachmentsGet',
  'type' => 'read',
  'name' => 'Courses Course Work Materials Add On Attachments Get',
  'description' => 'Courses Course Work Materials Add On Attachments Get (GET /v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_materials_add_on_attachments_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsAddOnAttachmentsDelete',
  'type' => 'write',
  'name' => 'Courses Course Work Materials Add On Attachments Delete',
  'description' => 'Courses Course Work Materials Add On Attachments Delete (DELETE /v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_courses_course_work_materials_add_on_attachments_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsAddOnAttachmentsList',
  'type' => 'read',
  'name' => 'Courses Course Work Materials Add On Attachments List',
  'description' => 'Courses Course Work Materials Add On Attachments List (GET /v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnAttachments).',
  'icon' => 'ph:magnifying-glass',
),
            'google_classroom_courses_course_work_materials_add_on_attachments_patch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomCoursesCourseWorkMaterialsAddOnAttachmentsPatch',
  'type' => 'write',
  'name' => 'Courses Course Work Materials Add On Attachments Patch',
  'description' => 'Courses Course Work Materials Add On Attachments Patch (PATCH /v1/courses/{courseId}/courseWorkMaterials/{itemId}/addOnAttachments/{attachmentId}).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_registrations_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomRegistrationsCreate',
  'type' => 'write',
  'name' => 'Registrations Create',
  'description' => 'Registrations Create (POST /v1/registrations).',
  'icon' => 'ph:chalkboard-teacher',
),
            'google_classroom_registrations_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleClassroom\\Tools\\GoogleClassroomRegistrationsDelete',
  'type' => 'write',
  'name' => 'Registrations Delete',
  'description' => 'Registrations Delete (DELETE /v1/registrations/{registrationId}).',
  'icon' => 'ph:chalkboard-teacher',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Classroom tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleClassroomService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleClassroomService(accessToken: $creds->get('google-classroom', 'access_token', '', $account), baseUrl: $creds->get('google-classroom', 'url', 'https://classroom.googleapis.com', $account));
        }
        return app(GoogleClassroomService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-classroom.md'; }
}