<?php

namespace OpenCompany\Integrations\Featurebase;

/**
 * Generated operation map for the Featurebase 2026-01-01.nova REST API.
 */
final class FeaturebaseOperations
{
    /**
     * Return documented Featurebase operations keyed by operation id.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'listboards' =>
  array (
    'method' => 'GET',
    'path' => '/v2/boards',
    'description' => 'Returns all boards (post categories) for the authenticated organization.',
    'class' => 'FeaturebaseListBoards',
    'slug' => 'featurebase_list_boards',
    'name' => 'List Boards',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getboard' =>
  array (
    'method' => 'GET',
    'path' => '/v2/boards/{id}',
    'description' => 'Retrieves a single board by its unique identifier.',
    'class' => 'FeaturebaseGetBoard',
    'slug' => 'featurebase_get_board',
    'name' => 'Get Board',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listposts' =>
  array (
    'method' => 'GET',
    'path' => '/v2/posts',
    'description' => 'Returns all posts (feedback submissions) for the authenticated organization.',
    'class' => 'FeaturebaseListPosts',
    'slug' => 'featurebase_list_posts',
    'name' => 'List Posts',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'createpost' =>
  array (
    'method' => 'POST',
    'path' => '/v2/posts',
    'description' => 'Creates a new post (feedback submission) in the specified board.',
    'class' => 'FeaturebaseCreatePost',
    'slug' => 'featurebase_create_post',
    'name' => 'Create Post',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getpost' =>
  array (
    'method' => 'GET',
    'path' => '/v2/posts/{id}',
    'description' => 'Retrieves a single post by its unique identifier.',
    'class' => 'FeaturebaseGetPost',
    'slug' => 'featurebase_get_post',
    'name' => 'Get Post',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'updatepost' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/posts/{id}',
    'description' => 'Updates an existing post. Only provided fields will be modified.',
    'class' => 'FeaturebaseUpdatePost',
    'slug' => 'featurebase_update_post',
    'name' => 'Update Post',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletepost' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/posts/{id}',
    'description' => 'Permanently deletes a post. This action cannot be undone.',
    'class' => 'FeaturebaseDeletePost',
    'slug' => 'featurebase_delete_post',
    'name' => 'Delete Post',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listvoters' =>
  array (
    'method' => 'GET',
    'path' => '/v2/posts/{id}/voters',
    'description' => 'Returns all voters (upvoters) for a specific post.',
    'class' => 'FeaturebaseListVoters',
    'slug' => 'featurebase_list_voters',
    'name' => 'List Voters',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'addvoter' =>
  array (
    'method' => 'POST',
    'path' => '/v2/posts/{id}/voters',
    'description' => 'Adds a voter (upvote) to a post.',
    'class' => 'FeaturebaseAddVoter',
    'slug' => 'featurebase_add_voter',
    'name' => 'Add Voter',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'removevoter' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/posts/{id}/voters',
    'description' => 'Removes a voter (upvote) from a post.',
    'class' => 'FeaturebaseRemoveVoter',
    'slug' => 'featurebase_remove_voter',
    'name' => 'Remove Voter',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listpoststatuses' =>
  array (
    'method' => 'GET',
    'path' => '/v2/post_statuses',
    'description' => 'Returns all post statuses for the authenticated organization.',
    'class' => 'FeaturebaseListPostStatuses',
    'slug' => 'featurebase_list_post_statuses',
    'name' => 'List Post Statuses',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getpoststatus' =>
  array (
    'method' => 'GET',
    'path' => '/v2/post_statuses/{id}',
    'description' => 'Retrieves a single post status by its unique identifier.',
    'class' => 'FeaturebaseGetPostStatus',
    'slug' => 'featurebase_get_post_status',
    'name' => 'Get Post Status',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listcomments' =>
  array (
    'method' => 'GET',
    'path' => '/v2/comments',
    'description' => 'Returns comments for your organization.',
    'class' => 'FeaturebaseListComments',
    'slug' => 'featurebase_list_comments',
    'name' => 'List Comments',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'createcomment' =>
  array (
    'method' => 'POST',
    'path' => '/v2/comments',
    'description' => 'Creates a new comment or reply to an existing comment.',
    'class' => 'FeaturebaseCreateComment',
    'slug' => 'featurebase_create_comment',
    'name' => 'Create Comment',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getcomment' =>
  array (
    'method' => 'GET',
    'path' => '/v2/comments/{id}',
    'description' => 'Retrieves a single comment by its unique identifier.',
    'class' => 'FeaturebaseGetComment',
    'slug' => 'featurebase_get_comment',
    'name' => 'Get Comment',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'updatecomment' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/comments/{id}',
    'description' => 'Updates an existing comment by its unique identifier.',
    'class' => 'FeaturebaseUpdateComment',
    'slug' => 'featurebase_update_comment',
    'name' => 'Update Comment',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletecomment' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/comments/{id}',
    'description' => 'Deletes a comment by its unique identifier.',
    'class' => 'FeaturebaseDeleteComment',
    'slug' => 'featurebase_delete_comment',
    'name' => 'Delete Comment',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletecommentclover' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/comment',
    'description' => 'Deletes a comment using the legacy Clover API format.',
    'class' => 'FeaturebaseDeleteCommentClover',
    'slug' => 'featurebase_delete_comment_clover',
    'name' => 'Delete Comment Clover',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'listcustomfields' =>
  array (
    'method' => 'GET',
    'path' => '/v2/custom_fields',
    'description' => 'Returns all custom fields configured in your organization.',
    'class' => 'FeaturebaseListCustomFields',
    'slug' => 'featurebase_list_custom_fields',
    'name' => 'List Custom Fields',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getcustomfield' =>
  array (
    'method' => 'GET',
    'path' => '/v2/custom_fields/{id}',
    'description' => 'Retrieves a single custom field by its unique identifier.',
    'class' => 'FeaturebaseGetCustomField',
    'slug' => 'featurebase_get_custom_field',
    'name' => 'Get Custom Field',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listchangelogs' =>
  array (
    'method' => 'GET',
    'path' => '/v2/changelogs',
    'description' => 'Returns all changelogs for the authenticated organization.',
    'class' => 'FeaturebaseListChangelogs',
    'slug' => 'featurebase_list_changelogs',
    'name' => 'List Changelogs',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'createchangelog' =>
  array (
    'method' => 'POST',
    'path' => '/v2/changelogs',
    'description' => 'Creates a new changelog for the authenticated organization.',
    'class' => 'FeaturebaseCreateChangelog',
    'slug' => 'featurebase_create_changelog',
    'name' => 'Create Changelog',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getchangelog' =>
  array (
    'method' => 'GET',
    'path' => '/v2/changelogs/{id}',
    'description' => 'Retrieves a single changelog by its unique identifier or slug.',
    'class' => 'FeaturebaseGetChangelog',
    'slug' => 'featurebase_get_changelog',
    'name' => 'Get Changelog',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'updatechangelog' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/changelogs/{id}',
    'description' => 'Updates an existing changelog by its unique identifier.',
    'class' => 'FeaturebaseUpdateChangelog',
    'slug' => 'featurebase_update_changelog',
    'name' => 'Update Changelog',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletechangelog' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/changelogs/{id}',
    'description' => 'Deletes a changelog by its unique identifier.',
    'class' => 'FeaturebaseDeleteChangelog',
    'slug' => 'featurebase_delete_changelog',
    'name' => 'Delete Changelog',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'publishchangelog' =>
  array (
    'method' => 'POST',
    'path' => '/v2/changelogs/{id}/publish',
    'description' => 'Publishes a changelog and optionally sends an email notification to subscribers.',
    'class' => 'FeaturebasePublishChangelog',
    'slug' => 'featurebase_publish_changelog',
    'name' => 'Publish Changelog',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'unpublishchangelog' =>
  array (
    'method' => 'POST',
    'path' => '/v2/changelogs/{id}/unpublish',
    'description' => 'Unpublishes a changelog, removing it from public view.',
    'class' => 'FeaturebaseUnpublishChangelog',
    'slug' => 'featurebase_unpublish_changelog',
    'name' => 'Unpublish Changelog',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'addchangelogsubscribers' =>
  array (
    'method' => 'POST',
    'path' => '/v2/changelogs/subscribers',
    'description' => 'Adds email addresses as changelog subscribers in bulk.',
    'class' => 'FeaturebaseAddChangelogSubscribers',
    'slug' => 'featurebase_add_changelog_subscribers',
    'name' => 'Add Changelog Subscribers',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'removechangelogsubscribers' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/changelogs/subscribers',
    'description' => 'Removes email addresses from changelog subscribers in bulk.',
    'class' => 'FeaturebaseRemoveChangelogSubscribers',
    'slug' => 'featurebase_remove_changelog_subscribers',
    'name' => 'Remove Changelog Subscribers',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'listadmins' =>
  array (
    'method' => 'GET',
    'path' => '/v2/admins',
    'description' => 'Returns all admins for your organization.',
    'class' => 'FeaturebaseListAdmins',
    'slug' => 'featurebase_list_admins',
    'name' => 'List Admins',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getadmin' =>
  array (
    'method' => 'GET',
    'path' => '/v2/admins/{id}',
    'description' => 'Retrieves a single admin by their unique identifier.',
    'class' => 'FeaturebaseGetAdmin',
    'slug' => 'featurebase_get_admin',
    'name' => 'Get Admin',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listadminroles' =>
  array (
    'method' => 'GET',
    'path' => '/v2/admins/roles',
    'description' => 'Returns all available admin roles and their permissions.',
    'class' => 'FeaturebaseListAdminRoles',
    'slug' => 'featurebase_list_admin_roles',
    'name' => 'List Admin Roles',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'listteams' =>
  array (
    'method' => 'GET',
    'path' => '/v2/teams',
    'description' => 'Returns all teams in your organization.',
    'class' => 'FeaturebaseListTeams',
    'slug' => 'featurebase_list_teams',
    'name' => 'List Teams',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getteambyid' =>
  array (
    'method' => 'GET',
    'path' => '/v2/teams/{id}',
    'description' => 'Retrieves a single team by its Featurebase ID.',
    'class' => 'FeaturebaseGetTeamById',
    'slug' => 'featurebase_get_team_by_id',
    'name' => 'Get Team By Id',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listbrands' =>
  array (
    'method' => 'GET',
    'path' => '/v2/brands',
    'description' => 'Returns all brands in your organization with cursor-based pagination.',
    'class' => 'FeaturebaseListBrands',
    'slug' => 'featurebase_list_brands',
    'name' => 'List Brands',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getbrandbyid' =>
  array (
    'method' => 'GET',
    'path' => '/v2/brands/{id}',
    'description' => 'Retrieves a single brand by its Featurebase ID.',
    'class' => 'FeaturebaseGetBrandById',
    'slug' => 'featurebase_get_brand_by_id',
    'name' => 'Get Brand By Id',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listcontacts' =>
  array (
    'method' => 'GET',
    'path' => '/v2/contacts',
    'description' => 'Returns a list of contacts (customers and leads) in your organization using cursor-based pagination.',
    'class' => 'FeaturebaseListContacts',
    'slug' => 'featurebase_list_contacts',
    'name' => 'List Contacts',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'upsertcontact' =>
  array (
    'method' => 'POST',
    'path' => '/v2/contacts',
    'description' => 'Creates a new contact or updates an existing one.',
    'class' => 'FeaturebaseUpsertContact',
    'slug' => 'featurebase_upsert_contact',
    'name' => 'Upsert Contact',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getcontactbyid' =>
  array (
    'method' => 'GET',
    'path' => '/v2/contacts/{id}',
    'description' => 'Retrieves a single contact by their Featurebase ID.',
    'class' => 'FeaturebaseGetContactById',
    'slug' => 'featurebase_get_contact_by_id',
    'name' => 'Get Contact By Id',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletecontactbyid' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/contacts/{id}',
    'description' => 'Permanently deletes a contact by their Featurebase ID.',
    'class' => 'FeaturebaseDeleteContactById',
    'slug' => 'featurebase_delete_contact_by_id',
    'name' => 'Delete Contact By Id',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'getcontactbyuserid' =>
  array (
    'method' => 'GET',
    'path' => '/v2/contacts/by-user-id/{userId}',
    'description' => 'Retrieves a single contact by their external user ID (from your system via SSO).',
    'class' => 'FeaturebaseGetContactByUserId',
    'slug' => 'featurebase_get_contact_by_user_id',
    'name' => 'Get Contact By User Id',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'userId',
    ),
  ),
  'deletecontactbyuserid' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/contacts/by-user-id/{userId}',
    'description' => 'Permanently deletes a contact by their external user ID.',
    'class' => 'FeaturebaseDeleteContactByUserId',
    'slug' => 'featurebase_delete_contact_by_user_id',
    'name' => 'Delete Contact By User Id',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'userId',
    ),
  ),
  'getcontactemailpreferencesbyid' =>
  array (
    'method' => 'GET',
    'path' => '/v2/contacts/{id}/email-preferences',
    'description' => 'Retrieves the email preference state for a customer contact by their Featurebase ID.',
    'class' => 'FeaturebaseGetContactEmailPreferencesById',
    'slug' => 'featurebase_get_contact_email_preferences_by_id',
    'name' => 'Get Contact Email Preferences By Id',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'updatecontactemailpreferencesbyid' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/contacts/{id}/email-preferences',
    'description' => 'Updates one or more email preferences for a customer contact by their Featurebase ID.',
    'class' => 'FeaturebaseUpdateContactEmailPreferencesById',
    'slug' => 'featurebase_update_contact_email_preferences_by_id',
    'name' => 'Update Contact Email Preferences By Id',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'getcontactemailpreferencesbyuserid' =>
  array (
    'method' => 'GET',
    'path' => '/v2/contacts/by-user-id/{userId}/email-preferences',
    'description' => 'Retrieves the email preference state for a customer contact by their external user ID.',
    'class' => 'FeaturebaseGetContactEmailPreferencesByUserId',
    'slug' => 'featurebase_get_contact_email_preferences_by_user_id',
    'name' => 'Get Contact Email Preferences By User Id',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'userId',
    ),
  ),
  'updatecontactemailpreferencesbyuserid' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/contacts/by-user-id/{userId}/email-preferences',
    'description' => 'Updates one or more email preferences for a customer contact by their external user ID.',
    'class' => 'FeaturebaseUpdateContactEmailPreferencesByUserId',
    'slug' => 'featurebase_update_contact_email_preferences_by_user_id',
    'name' => 'Update Contact Email Preferences By User Id',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'userId',
    ),
  ),
  'blockcontactbyid' =>
  array (
    'method' => 'POST',
    'path' => '/v2/contacts/{id}/block',
    'description' => 'Blocks a contact by their Featurebase ID from the messenger/inbox.',
    'class' => 'FeaturebaseBlockContactById',
    'slug' => 'featurebase_block_contact_by_id',
    'name' => 'Block Contact By Id',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'unblockcontactbyid' =>
  array (
    'method' => 'POST',
    'path' => '/v2/contacts/{id}/unblock',
    'description' => 'Unblocks a contact by their Featurebase ID from the messenger/inbox.',
    'class' => 'FeaturebaseUnblockContactById',
    'slug' => 'featurebase_unblock_contact_by_id',
    'name' => 'Unblock Contact By Id',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listcompanies' =>
  array (
    'method' => 'GET',
    'path' => '/v2/companies',
    'description' => 'Returns all companies in your organization with cursor-based pagination.',
    'class' => 'FeaturebaseListCompanies',
    'slug' => 'featurebase_list_companies',
    'name' => 'List Companies',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'upsertcompany' =>
  array (
    'method' => 'POST',
    'path' => '/v2/companies',
    'description' => 'Creates a new company or updates an existing one.',
    'class' => 'FeaturebaseUpsertCompany',
    'slug' => 'featurebase_upsert_company',
    'name' => 'Upsert Company',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getcompanybyid' =>
  array (
    'method' => 'GET',
    'path' => '/v2/companies/{id}',
    'description' => 'Retrieves a single company by its Featurebase ID.',
    'class' => 'FeaturebaseGetCompanyById',
    'slug' => 'featurebase_get_company_by_id',
    'name' => 'Get Company By Id',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletecompanybyid' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/companies/{id}',
    'description' => 'Deletes a company by its Featurebase ID.',
    'class' => 'FeaturebaseDeleteCompanyById',
    'slug' => 'featurebase_delete_company_by_id',
    'name' => 'Delete Company By Id',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletecompanybycompanyid' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/companies/by-company-id/{companyId}',
    'description' => 'Permanently deletes a company by its external company ID (the companyId from your system).',
    'class' => 'FeaturebaseDeleteCompanyByCompanyId',
    'slug' => 'featurebase_delete_company_by_company_id',
    'name' => 'Delete Company By Company Id',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'companyId',
    ),
  ),
  'listcompanycontacts' =>
  array (
    'method' => 'GET',
    'path' => '/v2/companies/{id}/contacts',
    'description' => 'Returns all contacts (customers) attached to a specific company.',
    'class' => 'FeaturebaseListCompanyContacts',
    'slug' => 'featurebase_list_company_contacts',
    'name' => 'List Company Contacts',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'attachcontacttocompany' =>
  array (
    'method' => 'POST',
    'path' => '/v2/companies/{id}/contacts',
    'description' => 'Attaches a contact (customer) to a company.',
    'class' => 'FeaturebaseAttachContactToCompany',
    'slug' => 'featurebase_attach_contact_to_company',
    'name' => 'Attach Contact To Company',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'removecontactfromcompany' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/companies/{id}/contacts/{contactId}',
    'description' => 'Removes a contact (customer) from a company.',
    'class' => 'FeaturebaseRemoveContactFromCompany',
    'slug' => 'featurebase_remove_contact_from_company',
    'name' => 'Remove Contact From Company',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
      1 => 'contactId',
    ),
  ),
  'listsurveys' =>
  array (
    'method' => 'GET',
    'path' => '/v2/surveys',
    'description' => 'Returns all surveys configured in your Featurebase organization.',
    'class' => 'FeaturebaseListSurveys',
    'slug' => 'featurebase_list_surveys',
    'name' => 'List Surveys',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getsurvey' =>
  array (
    'method' => 'GET',
    'path' => '/v2/surveys/{id}',
    'description' => 'Retrieves a single survey by its unique identifier.',
    'class' => 'FeaturebaseGetSurvey',
    'slug' => 'featurebase_get_survey',
    'name' => 'Get Survey',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'getsurveyresponses' =>
  array (
    'method' => 'GET',
    'path' => '/v2/surveys/{id}/responses',
    'description' => 'Retrieves all user responses for a specific survey.',
    'class' => 'FeaturebaseGetSurveyResponses',
    'slug' => 'featurebase_get_survey_responses',
    'name' => 'Get Survey Responses',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listhelpcenters' =>
  array (
    'method' => 'GET',
    'path' => '/v2/help_center/help_centers',
    'description' => 'Returns all help centers configured in your Featurebase organization.',
    'class' => 'FeaturebaseListHelpCenters',
    'slug' => 'featurebase_list_help_centers',
    'name' => 'List Help Centers',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'gethelpcenter' =>
  array (
    'method' => 'GET',
    'path' => '/v2/help_center/help_centers/{id}',
    'description' => 'Retrieves a single help center by its unique identifier.',
    'class' => 'FeaturebaseGetHelpCenter',
    'slug' => 'featurebase_get_help_center',
    'name' => 'Get Help Center',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listcollections' =>
  array (
    'method' => 'GET',
    'path' => '/v2/help_center/collections',
    'description' => 'Returns a paginated list of collections within your organization\'s help center.',
    'class' => 'FeaturebaseListCollections',
    'slug' => 'featurebase_list_collections',
    'name' => 'List Collections',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'createcollection' =>
  array (
    'method' => 'POST',
    'path' => '/v2/help_center/collections',
    'description' => 'Creates a new collection in your organization\'s help center.',
    'class' => 'FeaturebaseCreateCollection',
    'slug' => 'featurebase_create_collection',
    'name' => 'Create Collection',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getcollection' =>
  array (
    'method' => 'GET',
    'path' => '/v2/help_center/collections/{id}',
    'description' => 'Retrieves a specific collection by its unique identifier.',
    'class' => 'FeaturebaseGetCollection',
    'slug' => 'featurebase_get_collection',
    'name' => 'Get Collection',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'updatecollection' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/help_center/collections/{id}',
    'description' => 'Updates an existing collection. Only include the fields you wish to update.',
    'class' => 'FeaturebaseUpdateCollection',
    'slug' => 'featurebase_update_collection',
    'name' => 'Update Collection',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletecollection' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/help_center/collections/{id}',
    'description' => 'Deletes an existing collection.',
    'class' => 'FeaturebaseDeleteCollection',
    'slug' => 'featurebase_delete_collection',
    'name' => 'Delete Collection',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listarticles' =>
  array (
    'method' => 'GET',
    'path' => '/v2/help_center/articles',
    'description' => 'Returns a paginated list of articles within your organization\'s help center.',
    'class' => 'FeaturebaseListArticles',
    'slug' => 'featurebase_list_articles',
    'name' => 'List Articles',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'createarticle' =>
  array (
    'method' => 'POST',
    'path' => '/v2/help_center/articles',
    'description' => 'Creates a new article in your organization\'s help center.',
    'class' => 'FeaturebaseCreateArticle',
    'slug' => 'featurebase_create_article',
    'name' => 'Create Article',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getarticle' =>
  array (
    'method' => 'GET',
    'path' => '/v2/help_center/articles/{id}',
    'description' => 'Retrieves a specific article by its unique identifier.',
    'class' => 'FeaturebaseGetArticle',
    'slug' => 'featurebase_get_article',
    'name' => 'Get Article',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'updatearticle' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/help_center/articles/{id}',
    'description' => 'Updates an existing article. Only include the fields you wish to update.',
    'class' => 'FeaturebaseUpdateArticle',
    'slug' => 'featurebase_update_article',
    'name' => 'Update Article',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletearticle' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/help_center/articles/{id}',
    'description' => 'Deletes an existing article.',
    'class' => 'FeaturebaseDeleteArticle',
    'slug' => 'featurebase_delete_article',
    'name' => 'Delete Article',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listredirectrules' =>
  array (
    'method' => 'GET',
    'path' => '/v2/help_center/redirect_rules',
    'description' => 'Returns a paginated list of redirect rules within your organization.',
    'class' => 'FeaturebaseListRedirectRules',
    'slug' => 'featurebase_list_redirect_rules',
    'name' => 'List Redirect Rules',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'createredirectrule' =>
  array (
    'method' => 'POST',
    'path' => '/v2/help_center/redirect_rules',
    'description' => 'Creates a new redirect rule in your organization.',
    'class' => 'FeaturebaseCreateRedirectRule',
    'slug' => 'featurebase_create_redirect_rule',
    'name' => 'Create Redirect Rule',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getredirectrulebyurl' =>
  array (
    'method' => 'GET',
    'path' => '/v2/help_center/redirect_rules/by-url',
    'description' => 'Retrieves a specific redirect rule by its source URL.',
    'class' => 'FeaturebaseGetRedirectRuleByUrl',
    'slug' => 'featurebase_get_redirect_rule_by_url',
    'name' => 'Get Redirect Rule By Url',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getredirectrule' =>
  array (
    'method' => 'GET',
    'path' => '/v2/help_center/redirect_rules/{id}',
    'description' => 'Retrieves a specific redirect rule by its unique identifier.',
    'class' => 'FeaturebaseGetRedirectRule',
    'slug' => 'featurebase_get_redirect_rule',
    'name' => 'Get Redirect Rule',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'updateredirectrule' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/help_center/redirect_rules/{id}',
    'description' => 'Updates an existing redirect rule. Only include the fields you wish to update.',
    'class' => 'FeaturebaseUpdateRedirectRule',
    'slug' => 'featurebase_update_redirect_rule',
    'name' => 'Update Redirect Rule',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deleteredirectrule' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/help_center/redirect_rules/{id}',
    'description' => 'Deletes an existing redirect rule. The associated Redis cache entry is also invalidated.',
    'class' => 'FeaturebaseDeleteRedirectRule',
    'slug' => 'featurebase_delete_redirect_rule',
    'name' => 'Delete Redirect Rule',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listconversations' =>
  array (
    'method' => 'GET',
    'path' => '/v2/conversations',
    'description' => 'Returns a list of conversations in your organization using cursor-based pagination.',
    'class' => 'FeaturebaseListConversations',
    'slug' => 'featurebase_list_conversations',
    'name' => 'List Conversations',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'createconversation' =>
  array (
    'method' => 'POST',
    'path' => '/v2/conversations',
    'description' => 'Creates a new conversation. Supports both contact-initiated (customer/lead) and admin-initiated (outreach) conversations.',
    'class' => 'FeaturebaseCreateConversation',
    'slug' => 'featurebase_create_conversation',
    'name' => 'Create Conversation',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getconversationbyid' =>
  array (
    'method' => 'GET',
    'path' => '/v2/conversations/{id}',
    'description' => 'Retrieves a single conversation by its ID, including conversation parts (messages).',
    'class' => 'FeaturebaseGetConversationById',
    'slug' => 'featurebase_get_conversation_by_id',
    'name' => 'Get Conversation By Id',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deleteconversation' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/conversations/{id}',
    'description' => 'Permanently deletes a conversation by its short ID.',
    'class' => 'FeaturebaseDeleteConversation',
    'slug' => 'featurebase_delete_conversation',
    'name' => 'Delete Conversation',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'updateconversation' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/conversations/{id}',
    'description' => 'Updates a conversation\'s properties. Supports partial updates - only provided fields will be updated.',
    'class' => 'FeaturebaseUpdateConversation',
    'slug' => 'featurebase_update_conversation',
    'name' => 'Update Conversation',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'attachconversationtag' =>
  array (
    'method' => 'POST',
    'path' => '/v2/conversations/{id}/tags',
    'description' => 'Attaches a workspace tag to a conversation.',
    'class' => 'FeaturebaseAttachConversationTag',
    'slug' => 'featurebase_attach_conversation_tag',
    'name' => 'Attach Conversation Tag',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'detachconversationtag' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/conversations/{id}/tags/{tagId}',
    'description' => 'Removes a workspace tag from a conversation.',
    'class' => 'FeaturebaseDetachConversationTag',
    'slug' => 'featurebase_detach_conversation_tag',
    'name' => 'Detach Conversation Tag',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
      1 => 'tagId',
    ),
  ),
  'replytoconversation' =>
  array (
    'method' => 'POST',
    'path' => '/v2/conversations/{id}/reply',
    'description' => 'Adds a reply to an existing conversation. Supports both contact (customer/lead) and admin replies.',
    'class' => 'FeaturebaseReplyToConversation',
    'slug' => 'featurebase_reply_to_conversation',
    'name' => 'Reply To Conversation',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'addparticipanttoconversation' =>
  array (
    'method' => 'POST',
    'path' => '/v2/conversations/{id}/participants',
    'description' => 'Adds a contact (customer or lead) as a participant to an existing conversation.',
    'class' => 'FeaturebaseAddParticipantToConversation',
    'slug' => 'featurebase_add_participant_to_conversation',
    'name' => 'Add Participant To Conversation',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'removeparticipantfromconversation' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/conversations/{id}/participants',
    'description' => 'Removes a contact (customer or lead) from an existing conversation.',
    'class' => 'FeaturebaseRemoveParticipantFromConversation',
    'slug' => 'featurebase_remove_participant_from_conversation',
    'name' => 'Remove Participant From Conversation',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'redactconversationpart' =>
  array (
    'method' => 'POST',
    'path' => '/v2/conversations/redact',
    'description' => 'Redacts a conversation part (message) from a conversation. Redaction permanently removes the message content while preserving the conversation structure.',
    'class' => 'FeaturebaseRedactConversationPart',
    'slug' => 'featurebase_redact_conversation_part',
    'name' => 'Redact Conversation Part',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'listtags' =>
  array (
    'method' => 'GET',
    'path' => '/v2/tags',
    'description' => 'Returns the live conversation tags available in the workspace tag catalog. These are the canonical tags that power conversation payloads, filters, and tag mutation endpoints.',
    'class' => 'FeaturebaseListTags',
    'slug' => 'featurebase_list_tags',
    'name' => 'List Tags',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'upserttag' =>
  array (
    'method' => 'POST',
    'path' => '/v2/tags',
    'description' => 'Creates a new workspace conversation tag when only name is provided. If id is also provided, the existing tag is renamed instead.',
    'class' => 'FeaturebaseUpsertTag',
    'slug' => 'featurebase_upsert_tag',
    'name' => 'Upsert Tag',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'gettagbyid' =>
  array (
    'method' => 'GET',
    'path' => '/v2/tags/{id}',
    'description' => 'Returns a single conversation tag by its Featurebase tag ID. Archived tags can still be retrieved directly by ID, while permanently deleted tags return 404.',
    'class' => 'FeaturebaseGetTagById',
    'slug' => 'featurebase_get_tag_by_id',
    'name' => 'Get Tag By Id',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletetag' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/tags/{id}',
    'description' => 'Deletes a conversation tag from the workspace catalog and removes it from aggregate conversation tag state. Archived and historical part applications remain part of the audit trail where applicable.',
    'class' => 'FeaturebaseDeleteTag',
    'slug' => 'featurebase_delete_tag',
    'name' => 'Delete Tag',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listtickets' =>
  array (
    'method' => 'GET',
    'path' => '/v2/tickets',
    'description' => 'Returns a list of tickets in your organization using cursor-based pagination.',
    'class' => 'FeaturebaseListTickets',
    'slug' => 'featurebase_list_tickets',
    'name' => 'List Tickets',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'createticket' =>
  array (
    'method' => 'POST',
    'path' => '/v2/tickets',
    'description' => 'Creates a new ticket.',
    'class' => 'FeaturebaseCreateTicket',
    'slug' => 'featurebase_create_ticket',
    'name' => 'Create Ticket',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getticket' =>
  array (
    'method' => 'GET',
    'path' => '/v2/tickets/{id}',
    'description' => 'Retrieves a single ticket by its ticket number.',
    'class' => 'FeaturebaseGetTicket',
    'slug' => 'featurebase_get_ticket',
    'name' => 'Get Ticket',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'updateticket' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/tickets/{id}',
    'description' => 'Updates a ticket\'s properties. Only provided fields will be updated.',
    'class' => 'FeaturebaseUpdateTicket',
    'slug' => 'featurebase_update_ticket',
    'name' => 'Update Ticket',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deleteticket' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/tickets/{id}',
    'description' => 'Permanently deletes a ticket by its ticket number.',
    'class' => 'FeaturebaseDeleteTicket',
    'slug' => 'featurebase_delete_ticket',
    'name' => 'Delete Ticket',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'replytoticket' =>
  array (
    'method' => 'POST',
    'path' => '/v2/tickets/{id}/reply',
    'description' => 'Adds a reply to a ticket\'s linked conversation. Supports both contact and admin replies.',
    'class' => 'FeaturebaseReplyToTicket',
    'slug' => 'featurebase_reply_to_ticket',
    'name' => 'Reply To Ticket',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listticketcustomfields' =>
  array (
    'method' => 'GET',
    'path' => '/v2/tickets/custom_fields',
    'description' => 'Returns all custom fields configured in your organization that can be used on tickets.',
    'class' => 'FeaturebaseListTicketCustomFields',
    'slug' => 'featurebase_list_ticket_custom_fields',
    'name' => 'List Ticket Custom Fields',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getticketcustomfield' =>
  array (
    'method' => 'GET',
    'path' => '/v2/tickets/custom_fields/{id}',
    'description' => 'Retrieves a single custom field by its unique identifier.',
    'class' => 'FeaturebaseGetTicketCustomField',
    'slug' => 'featurebase_get_ticket_custom_field',
    'name' => 'Get Ticket Custom Field',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listticketcategories' =>
  array (
    'method' => 'GET',
    'path' => '/v2/tickets/categories',
    'description' => 'Returns all ticket categories for the authenticated organization.',
    'class' => 'FeaturebaseListTicketCategories',
    'slug' => 'featurebase_list_ticket_categories',
    'name' => 'List Ticket Categories',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getticketcategory' =>
  array (
    'method' => 'GET',
    'path' => '/v2/tickets/categories/{id}',
    'description' => 'Retrieves a single ticket category by its unique identifier.',
    'class' => 'FeaturebaseGetTicketCategory',
    'slug' => 'featurebase_get_ticket_category',
    'name' => 'Get Ticket Category',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listticketstatuses' =>
  array (
    'method' => 'GET',
    'path' => '/v2/tickets/statuses',
    'description' => 'Returns all ticket statuses for the authenticated organization.',
    'class' => 'FeaturebaseListTicketStatuses',
    'slug' => 'featurebase_list_ticket_statuses',
    'name' => 'List Ticket Statuses',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'getticketstatus' =>
  array (
    'method' => 'GET',
    'path' => '/v2/tickets/statuses/{id}',
    'description' => 'Retrieves a single ticket status by its unique identifier.',
    'class' => 'FeaturebaseGetTicketStatus',
    'slug' => 'featurebase_get_ticket_status',
    'name' => 'Get Ticket Status',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'listwebhooks' =>
  array (
    'method' => 'GET',
    'path' => '/v2/webhooks',
    'description' => 'Returns a list of webhooks in your organization using cursor-based pagination.',
    'class' => 'FeaturebaseListWebhooks',
    'slug' => 'featurebase_list_webhooks',
    'name' => 'List Webhooks',
    'type' => 'read',
    'pathParams' =>
    array (
    ),
  ),
  'createwebhook' =>
  array (
    'method' => 'POST',
    'path' => '/v2/webhooks',
    'description' => 'Creates a new webhook to receive event notifications.',
    'class' => 'FeaturebaseCreateWebhook',
    'slug' => 'featurebase_create_webhook',
    'name' => 'Create Webhook',
    'type' => 'write',
    'pathParams' =>
    array (
    ),
  ),
  'getwebhookbyid' =>
  array (
    'method' => 'GET',
    'path' => '/v2/webhooks/{id}',
    'description' => 'Retrieves a single webhook by its unique identifier.',
    'class' => 'FeaturebaseGetWebhookById',
    'slug' => 'featurebase_get_webhook_by_id',
    'name' => 'Get Webhook By Id',
    'type' => 'read',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'updatewebhook' =>
  array (
    'method' => 'PATCH',
    'path' => '/v2/webhooks/{id}',
    'description' => 'Updates a webhook\'s properties. Supports partial updates - only provided fields will be updated.',
    'class' => 'FeaturebaseUpdateWebhook',
    'slug' => 'featurebase_update_webhook',
    'name' => 'Update Webhook',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'deletewebhook' =>
  array (
    'method' => 'DELETE',
    'path' => '/v2/webhooks/{id}',
    'description' => 'Permanently deletes a webhook.',
    'class' => 'FeaturebaseDeleteWebhook',
    'slug' => 'featurebase_delete_webhook',
    'name' => 'Delete Webhook',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
  'refreshwebhooksecret' =>
  array (
    'method' => 'POST',
    'path' => '/v2/webhooks/{id}/secret',
    'description' => 'Generates a new signing secret for a webhook. The previous secret is immediately invalidated.',
    'class' => 'FeaturebaseRefreshWebhookSecret',
    'slug' => 'featurebase_refresh_webhook_secret',
    'name' => 'Refresh Webhook Secret',
    'type' => 'write',
    'pathParams' =>
    array (
      0 => 'id',
    ),
  ),
);
    }
}
