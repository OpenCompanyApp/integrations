<?php

namespace OpenCompany\Integrations\GoogleDrive;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Drive.
 *
 * Exposes generated coverage for the official Google Drive API v3 Discovery
 * document, including files, permissions, comments, replies, drives, and uploads.
 */
class GoogleDriveToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth'=>['strategy'=>'oauth2_manual_token','legacy_auth_type'=>'oauth','credential_mode'=>'stored_token','setup_flows'=>['manual_token'],'requires_browser_for_setup'=>false,'refreshable'=>false,'token_keys'=>['access_token'],'notes'=>['Requires a Google OAuth access token with Drive API scopes.']],'host_availability'=>['web'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token'],'cli'=>['setup_supported'=>true,'runtime_supported'=>true,'setup_mode'=>'manual_token','runtime_mode'=>'normal']],'runtime_requirements'=>[],'compatibility'=>['web_setup_supported'=>true,'web_runtime_supported'=>true,'cli_setup_supported'=>true,'cli_runtime_supported'=>true]]; }
    public function appName(): string { return 'google-drive'; }
    public function appMeta(): array { return ['label'=>'Google Drive','description'=>'Files, permissions, comments, replies, drives, changes, revisions, approvals, and uploads','icon'=>'ph:google-drive-logo','logo'=>'logos:google-drive']; }
    public function integrationMeta(): array { return ['name'=>'Google Drive','description'=>'Generated coverage for Google Drive API v3: files, permissions, comments, replies, drives, changes, revisions, approvals, apps, channels, operations, and uploads.','icon'=>'ph:google-drive-logo','logo'=>'logos:google-drive','category'=>'productivity','badge'=>'verified','docs_url'=>'https://developers.google.com/drive/api/reference/rest/v3']; }
    public function configSchema(): array { return [['key'=>'access_token','type'=>'secret','label'=>'Access Token','placeholder'=>'Google OAuth access token','hint'=>'Use a Google OAuth 2.0 token with Drive API scopes.','required'=>true], ['key'=>'url','type'=>'url','label'=>'API Base URL','placeholder'=>'https://www.googleapis.com','hint'=>'Override only for a proxy or compatible endpoint.','default'=>'https://www.googleapis.com']]; }
    /**
     * Verify Google Drive credentials with a lightweight files list call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array { $accessToken=(string)($config['access_token']??''); $baseUrl=rtrim((string)($config['url']??'https://www.googleapis.com'),'/'); if($accessToken==='') return ['success'=>false,'error'=>'No access token provided.']; try{$response=Http::withToken($accessToken)->acceptJson()->timeout(20)->get($baseUrl.'/drive/v3/files', ['pageSize'=>1]); return $response->successful()?['success'=>true,'message'=>'Google Drive credentials verified.']:['success'=>false,'error'=>'Google Drive API returned HTTP '.$response->status().'.'];}catch(\Throwable $e){return ['success'=>false,'error'=>$e->getMessage()];} }
    public function validationRules(): array { return ['access_token'=>'nullable|string','url'=>'nullable|url']; }
    public function tools(): array { return [
        'google_drive_approvals_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveApprovalsList',
  'type' => 'read',
  'name' => 'Approvals List',
  'description' => 'Approvals List (GET /drive/v3/files/{fileId}/approvals).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_approvals_decline' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveApprovalsDecline',
  'type' => 'write',
  'name' => 'Approvals Decline',
  'description' => 'Approvals Decline (POST /drive/v3/files/{fileId}/approvals/{approvalId}:decline).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_approvals_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveApprovalsGet',
  'type' => 'read',
  'name' => 'Approvals Get',
  'description' => 'Approvals Get (GET /drive/v3/files/{fileId}/approvals/{approvalId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_approvals_start' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveApprovalsStart',
  'type' => 'write',
  'name' => 'Approvals Start',
  'description' => 'Approvals Start (POST /drive/v3/files/{fileId}/approvals:start).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_approvals_cancel' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveApprovalsCancel',
  'type' => 'write',
  'name' => 'Approvals Cancel',
  'description' => 'Approvals Cancel (POST /drive/v3/files/{fileId}/approvals/{approvalId}:cancel).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_approvals_approve' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveApprovalsApprove',
  'type' => 'write',
  'name' => 'Approvals Approve',
  'description' => 'Approvals Approve (POST /drive/v3/files/{fileId}/approvals/{approvalId}:approve).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_approvals_comment' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveApprovalsComment',
  'type' => 'write',
  'name' => 'Approvals Comment',
  'description' => 'Approvals Comment (POST /drive/v3/files/{fileId}/approvals/{approvalId}:comment).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_approvals_reassign' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveApprovalsReassign',
  'type' => 'write',
  'name' => 'Approvals Reassign',
  'description' => 'Approvals Reassign (POST /drive/v3/files/{fileId}/approvals/{approvalId}:reassign).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_comments_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveCommentsList',
  'type' => 'read',
  'name' => 'Comments List',
  'description' => 'Comments List (GET /drive/v3/files/{fileId}/comments).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_comments_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveCommentsUpdate',
  'type' => 'write',
  'name' => 'Comments Update',
  'description' => 'Comments Update (PATCH /drive/v3/files/{fileId}/comments/{commentId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_comments_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveCommentsDelete',
  'type' => 'write',
  'name' => 'Comments Delete',
  'description' => 'Comments Delete (DELETE /drive/v3/files/{fileId}/comments/{commentId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_comments_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveCommentsCreate',
  'type' => 'write',
  'name' => 'Comments Create',
  'description' => 'Comments Create (POST /drive/v3/files/{fileId}/comments).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_comments_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveCommentsGet',
  'type' => 'read',
  'name' => 'Comments Get',
  'description' => 'Comments Get (GET /drive/v3/files/{fileId}/comments/{commentId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_files_modify_labels' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesModifyLabels',
  'type' => 'write',
  'name' => 'Files Modify Labels',
  'description' => 'Files Modify Labels (POST /drive/v3/files/{fileId}/modifyLabels).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_files_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesDelete',
  'type' => 'write',
  'name' => 'Files Delete',
  'description' => 'Files Delete (DELETE /drive/v3/files/{fileId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_files_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesCreate',
  'type' => 'write',
  'name' => 'Files Create',
  'description' => 'Files Create (POST /drive/v3/files).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_files_generate_cse_token' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesGenerateCseToken',
  'type' => 'read',
  'name' => 'Files Generate Cse Token',
  'description' => 'Files Generate Cse Token (GET /drive/v3/files/generateCseToken).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_files_watch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesWatch',
  'type' => 'write',
  'name' => 'Files Watch',
  'description' => 'Files Watch (POST /drive/v3/files/{fileId}/watch).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_files_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesList',
  'type' => 'read',
  'name' => 'Files List',
  'description' => 'Files List (GET /drive/v3/files).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_files_list_labels' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesListLabels',
  'type' => 'read',
  'name' => 'Files List Labels',
  'description' => 'Files List Labels (GET /drive/v3/files/{fileId}/listLabels).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_files_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesUpdate',
  'type' => 'write',
  'name' => 'Files Update',
  'description' => 'Files Update (PATCH /drive/v3/files/{fileId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_files_download' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesDownload',
  'type' => 'write',
  'name' => 'Files Download',
  'description' => 'Files Download (POST /drive/v3/files/{fileId}/download).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_files_generate_ids' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesGenerateIds',
  'type' => 'read',
  'name' => 'Files Generate Ids',
  'description' => 'Files Generate Ids (GET /drive/v3/files/generateIds).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_files_export' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesExport',
  'type' => 'read',
  'name' => 'Files Export',
  'description' => 'Files Export (GET /drive/v3/files/{fileId}/export).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_files_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesGet',
  'type' => 'read',
  'name' => 'Files Get',
  'description' => 'Files Get (GET /drive/v3/files/{fileId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_files_copy' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesCopy',
  'type' => 'write',
  'name' => 'Files Copy',
  'description' => 'Files Copy (POST /drive/v3/files/{fileId}/copy).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_files_empty_trash' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveFilesEmptyTrash',
  'type' => 'write',
  'name' => 'Files Empty Trash',
  'description' => 'Files Empty Trash (DELETE /drive/v3/files/trash).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_about_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveAboutGet',
  'type' => 'read',
  'name' => 'About Get',
  'description' => 'About Get (GET /drive/v3/about).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_channels_stop' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveChannelsStop',
  'type' => 'write',
  'name' => 'Channels Stop',
  'description' => 'Channels Stop (POST /drive/v3/channels/stop).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_permissions_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDrivePermissionsDelete',
  'type' => 'write',
  'name' => 'Permissions Delete',
  'description' => 'Permissions Delete (DELETE /drive/v3/files/{fileId}/permissions/{permissionId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_permissions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDrivePermissionsList',
  'type' => 'read',
  'name' => 'Permissions List',
  'description' => 'Permissions List (GET /drive/v3/files/{fileId}/permissions).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_permissions_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDrivePermissionsUpdate',
  'type' => 'write',
  'name' => 'Permissions Update',
  'description' => 'Permissions Update (PATCH /drive/v3/files/{fileId}/permissions/{permissionId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_permissions_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDrivePermissionsCreate',
  'type' => 'write',
  'name' => 'Permissions Create',
  'description' => 'Permissions Create (POST /drive/v3/files/{fileId}/permissions).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_permissions_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDrivePermissionsGet',
  'type' => 'read',
  'name' => 'Permissions Get',
  'description' => 'Permissions Get (GET /drive/v3/files/{fileId}/permissions/{permissionId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_apps_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveAppsList',
  'type' => 'read',
  'name' => 'Apps List',
  'description' => 'Apps List (GET /drive/v3/apps).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_apps_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveAppsGet',
  'type' => 'read',
  'name' => 'Apps Get',
  'description' => 'Apps Get (GET /drive/v3/apps/{appId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_accessproposals_resolve' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveAccessproposalsResolve',
  'type' => 'write',
  'name' => 'Accessproposals Resolve',
  'description' => 'Accessproposals Resolve (POST /drive/v3/files/{fileId}/accessproposals/{proposalId}:resolve).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_accessproposals_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveAccessproposalsList',
  'type' => 'read',
  'name' => 'Accessproposals List',
  'description' => 'Accessproposals List (GET /drive/v3/files/{fileId}/accessproposals).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_accessproposals_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveAccessproposalsGet',
  'type' => 'read',
  'name' => 'Accessproposals Get',
  'description' => 'Accessproposals Get (GET /drive/v3/files/{fileId}/accessproposals/{proposalId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_operations_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveOperationsGet',
  'type' => 'read',
  'name' => 'Operations Get',
  'description' => 'Operations Get (GET /drive/v3/operations/{name}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_revisions_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveRevisionsGet',
  'type' => 'read',
  'name' => 'Revisions Get',
  'description' => 'Revisions Get (GET /drive/v3/files/{fileId}/revisions/{revisionId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_revisions_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveRevisionsDelete',
  'type' => 'write',
  'name' => 'Revisions Delete',
  'description' => 'Revisions Delete (DELETE /drive/v3/files/{fileId}/revisions/{revisionId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_revisions_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveRevisionsList',
  'type' => 'read',
  'name' => 'Revisions List',
  'description' => 'Revisions List (GET /drive/v3/files/{fileId}/revisions).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_revisions_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveRevisionsUpdate',
  'type' => 'write',
  'name' => 'Revisions Update',
  'description' => 'Revisions Update (PATCH /drive/v3/files/{fileId}/revisions/{revisionId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_teamdrives_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveTeamdrivesDelete',
  'type' => 'write',
  'name' => 'Teamdrives Delete',
  'description' => 'Teamdrives Delete (DELETE /drive/v3/teamdrives/{teamDriveId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_teamdrives_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveTeamdrivesList',
  'type' => 'read',
  'name' => 'Teamdrives List',
  'description' => 'Teamdrives List (GET /drive/v3/teamdrives).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_teamdrives_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveTeamdrivesUpdate',
  'type' => 'write',
  'name' => 'Teamdrives Update',
  'description' => 'Teamdrives Update (PATCH /drive/v3/teamdrives/{teamDriveId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_teamdrives_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveTeamdrivesCreate',
  'type' => 'write',
  'name' => 'Teamdrives Create',
  'description' => 'Teamdrives Create (POST /drive/v3/teamdrives).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_teamdrives_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveTeamdrivesGet',
  'type' => 'read',
  'name' => 'Teamdrives Get',
  'description' => 'Teamdrives Get (GET /drive/v3/teamdrives/{teamDriveId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_changes_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveChangesList',
  'type' => 'read',
  'name' => 'Changes List',
  'description' => 'Changes List (GET /drive/v3/changes).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_changes_get_start_page_token' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveChangesGetStartPageToken',
  'type' => 'read',
  'name' => 'Changes Get Start Page Token',
  'description' => 'Changes Get Start Page Token (GET /drive/v3/changes/startPageToken).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_changes_watch' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveChangesWatch',
  'type' => 'write',
  'name' => 'Changes Watch',
  'description' => 'Changes Watch (POST /drive/v3/changes/watch).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_replies_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveRepliesCreate',
  'type' => 'write',
  'name' => 'Replies Create',
  'description' => 'Replies Create (POST /drive/v3/files/{fileId}/comments/{commentId}/replies).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_replies_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveRepliesGet',
  'type' => 'read',
  'name' => 'Replies Get',
  'description' => 'Replies Get (GET /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_replies_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveRepliesList',
  'type' => 'read',
  'name' => 'Replies List',
  'description' => 'Replies List (GET /drive/v3/files/{fileId}/comments/{commentId}/replies).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_replies_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveRepliesUpdate',
  'type' => 'write',
  'name' => 'Replies Update',
  'description' => 'Replies Update (PATCH /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_replies_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveRepliesDelete',
  'type' => 'write',
  'name' => 'Replies Delete',
  'description' => 'Replies Delete (DELETE /drive/v3/files/{fileId}/comments/{commentId}/replies/{replyId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_drives_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveDrivesCreate',
  'type' => 'write',
  'name' => 'Drives Create',
  'description' => 'Drives Create (POST /drive/v3/drives).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_drives_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveDrivesGet',
  'type' => 'read',
  'name' => 'Drives Get',
  'description' => 'Drives Get (GET /drive/v3/drives/{driveId}).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_drives_hide' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveDrivesHide',
  'type' => 'write',
  'name' => 'Drives Hide',
  'description' => 'Drives Hide (POST /drive/v3/drives/{driveId}/hide).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_drives_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveDrivesDelete',
  'type' => 'write',
  'name' => 'Drives Delete',
  'description' => 'Drives Delete (DELETE /drive/v3/drives/{driveId}).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_drives_unhide' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveDrivesUnhide',
  'type' => 'write',
  'name' => 'Drives Unhide',
  'description' => 'Drives Unhide (POST /drive/v3/drives/{driveId}/unhide).',
  'icon' => 'ph:google-drive-logo',
),
        'google_drive_drives_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveDrivesList',
  'type' => 'read',
  'name' => 'Drives List',
  'description' => 'Drives List (GET /drive/v3/drives).',
  'icon' => 'ph:magnifying-glass',
),
        'google_drive_drives_update' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleDrive\\Tools\\GoogleDriveDrivesUpdate',
  'type' => 'write',
  'name' => 'Drives Update',
  'description' => 'Drives Update (PATCH /drive/v3/drives/{driveId}).',
  'icon' => 'ph:google-drive-logo',
),
    ]; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }
    /** @param  array<string, mixed>  $context  Optional account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Tool creation context. */
    private function resolveService(array $context = []): GoogleDriveService { $account=$context['account']??null; if($account!==null){$creds=app(CredentialResolver::class); return new GoogleDriveService(accessToken: $creds->get('google-drive','access_token','',$account), baseUrl: $creds->get('google-drive','url','https://www.googleapis.com',$account));} return app(GoogleDriveService::class); }
    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-drive.md'; }
}
